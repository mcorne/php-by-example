<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/object.php';

class function_configurator extends object
{
    function assign_values_to_params($function_call, $args, $function_name)
    {
        try {
            $params = array();
            $names = array_keys($args);

            if ($function_name == 'array') {
                // this is array() pseudo function, encloses the function call into an array
                $function_call = "array($function_call)";
            }

            if ($values = $this->_parser->parse_value("array($function_call)", false)) {
                foreach($values as $index => $value)  {
                    if (isset($names[$index])) {
                        $name = $names[$index];
                        $params[$name] = $value;
                    }
                }
            }

        } catch (Exception $e) {
        }

        return $params;
    }

    function make_config($argv)
    {
        if (! isset($argv[1])) {
            throw new Exception('function name missing');
        }

        $function_name = $argv[1];
        $function_manual_basename = str_replace('_', '-', $function_name);
        $function_manual_page = __DIR__ . "/../public/manual/en/function.$function_manual_basename.html";

        if (! file_exists($function_manual_page)) {
            throw new Exception('invalid manual page');
        }

        $function_sub_directory = $function_name[0];
        $function_config_filename = __DIR__ . "/../application/functions/$function_sub_directory/$function_name.php";

        if (file_exists($function_config_filename)) {
            throw new Exception('function already configured');
        }

        if (! $html = file_get_contents($function_manual_page)) {
            throw new Exception('cannot read the manual page');
        }

        $synopsis = $this->parse_synopsis($html);
        $args = $this->parse_args($synopsis, $function_name);
        $examples = $this->parse_examples($html, $function_name, $args);
        $examples = $this->write_examples($examples);

        $config = $this->write_function_config($function_config_filename, $function_name, $examples, $synopsis);

        return $config;
    }

    function parse_example($example, $function_name, $args)
    {
        $example = $this->strip_example($example, $function_name);

        if ($function_calls = $this->parse_function_calls($example, $function_name)) {
            $vars_values = $this->parse_vars_values($example);
            $function_calls = $this->replace_functions_vars_with_values($function_calls, $vars_values, $args, $function_name);
        }

        return $function_calls;
    }

    function parse_examples($html, $function_name, $args)
    {
    	if (! preg_match_all('~<div class="example-contents">(.*?)</div>~s', $html, $matches)) {
    		return false;
    	}

    	list(, $examples) = $matches;
    	$function_calls = array();

    	foreach($examples as $example) {
            $function_calls = array_merge($function_calls, $this->parse_example($example, $function_name, $args));
    	}

    	return array_filter($function_calls);
    }

    function parse_function_calls($string, $function_name)
    {
        $function_calls = array();

        if (! preg_match_all('~(\(?' . $function_name . '\s*\(.+?)\);~s', $string, $matches)) {
            // no function calls, ex. array_diff($array1, $array2);
            return array();
        }

        list(, $function_calls) = $matches;

        foreach($function_calls as &$function_call) {
            if ($function_call[0] == '(') {
                // the function is called within another function, ex. print_r()
                // ex. print_r(array_change_key_case($input_array, CASE_UPPER));
                // removes other function parenthesis
                $function_call = substr($function_call, 1, -1);
            }

            // removes function name
            $function_call = preg_replace('~^' . $function_name . '\s*\(~', '', $function_call);
        }

        return $function_calls;
    }

    function parse_args($synopsis, $function_name)
    {
        if ($function_name == 'array') {
            // this is the pseudo function array(), forces param to $array
            // as it is used as such in the sort() family functions
            $params = array('array' => '$array');

        } else if (preg_match_all('~&?\$(\w+)~', $synopsis, $matches)) {
            // the function has arguments, ex. $bar, &$baz
            list($params_names, $vars_names) = $matches;
            $params = array_combine($params_names, $vars_names);

        } else {
            // the function has no arguments
            $params = array();
        }

        return $params;
    }

    function replace_function_vars_with_values($function_call, &$vars_values)
    {
        if (preg_match_all('~\$\w+~s', $function_call, $matches)) {
            list($vars) = $matches;

            foreach($vars as $var) {
                if (isset($vars_values[$var])) {
                    $function_call = str_replace($var, $vars_values[$var], $function_call);
                    unset($vars_values[$var]);
                } else {
                    $function_call = str_replace($var, '', $function_call);
                }
            }
        }

        return $function_call;
    }

    function replace_functions_vars_with_values($function_calls, $vars_values, $args, $function_name)
    {
        foreach($function_calls as &$function_call) {
            $function_call = $this->replace_function_vars_with_values($function_call, $vars_values);
            $function_call = $this->assign_values_to_params($function_call, $args, $function_name);
        }

        return $function_calls;
    }

    function parse_vars_values($string)
    {
    	if ( ! preg_match_all('~(\$\w+)\s*=\s*(.+?);~s', $string, $matches)) {
    		return array();
    	}

    	list(, $names, $values) = $matches;
    	$vars_values = array_combine($names, $values);

    	return $vars_values;
    }

    function strip_example($html, $function_name)
    {
        // replaces HTML line breaks with regular line breaks
        $html = preg_replace('~<br.*?>~', "\n", $html);
        // removes all HTML tags
        $html = strip_tags($html);
        // decodes non breaking spaces into regular spaces
        $html = str_replace('&nbsp;', ' ', $html);
        // decodes all HTML entities
        $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
        // removes PHP comments
        $html = preg_replace('~/\*.+?\*/~s', '', $html);
        $html = preg_replace('~//.+?$~m', '', $html);
        // removes function call return variables, ex. $abs in $abs = abs(...)
        $html = preg_replace('~(\$\w+\s*=\s*)(?=' . $function_name . '\()~s', '', $html);

        return $html;
    }

    function parse_synopsis($html)
    {
        if (! preg_match('~<div class="methodsynopsis dc-description">(.+?)</div>~s', $html, $match)) {
            throw new Exception('cannot parse the synopsis');
        }

        // strips tags and extra spaces
        $synopsis = strip_tags($match[1]);
        $synopsis = preg_replace('~\s+~', ' ', $synopsis);
        $synopsis = trim($synopsis);

        return $synopsis;
    }

    function write_function_config($function_config_filename, $classname, $examples, $synopsis)
    {
        $format =
'<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class %s extends function_core
{
    public $examples = [%s];

    public $synopsis = \'%s\';
}
';

        $config = sprintf($format, $classname, $examples, $synopsis);

        $directory = dirname($function_config_filename);

        if (! is_dir($directory) and ! mkdir($directory)) {
            throw new Exception('cannot create directory');
        }

        if (! file_put_contents($function_config_filename, $config)) {
            throw new Exception('cannot write function config');
        }

        return $config;
    }

    function write_example($example)
    {
        $example_values = array_map([$this->_converter, 'convert_value_to_text'], $example);
        $example_values = implode(', ', $example_values);

        if (count($example) != 1) {
            $example_values = "[$example_values]";
        }

        return $example_values;
    }

    function write_examples($examples)
    {
        $has_multi_value_example = false;

        foreach ($examples as $example) {
            $example_values = $this->write_example($example);
            $examples_values[] = $example_values;

            if (! $has_multi_value_example and $example_values[0] == '[') {
                $has_multi_value_example = true;
            }
        }

        if ($has_multi_value_example) {
            $examples_values = "\n            " . implode(",\n            ", $examples_values) . "\n    ";
        } else {
            $examples_values = implode(', ', $examples_values);
        }

        return $examples_values;
    }
}

try {
    $function_configurator = new function_configurator(['application_path' => $application_path]);
    $config = $function_configurator->make_config($argv);
    echo $config;

} catch (Exception $e) {
    echo $e->getMessage();
}
