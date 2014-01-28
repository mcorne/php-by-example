<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

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

            if ($values = $this->_parser->parse_value("array($function_call)", $function_name, false)) {
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

    function create_function_config($function_name, $html)
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

        $synopsis = $this->parse_synopsis($html);
        $args = $this->parse_args($synopsis, $function_name);
        $examples = $this->parse_examples($html, $function_name, $args);
        $examples = $this->export_examples($examples);
        $config = sprintf($format, $function_name, $examples, $synopsis);

        return $config;
    }

    function display_configs($configs)
    {
        $configs = "\n" . implode("\n\n", $configs);

        return $configs;
    }

    function export_example($example)
    {
        $example_values = [];

        foreach ($example as $example_value) {
            $example_values[] = $this->_converter->convert_value_to_text($example_value, false, true);
        }

        $example_values = implode(', ', $example_values);

        if (count($example) != 1) {
            $example_values = "[$example_values]";
        }

        return $example_values;
    }

    function export_examples($examples)
    {
        $has_multi_value_example = false;

        foreach ($examples as $example) {
            $example_values = $this->export_example($example);
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

    function get_function_config_filename($function_name)
    {
        $function_sub_directory = $function_name[0];
        $function_config_filename = __DIR__ . "/../application/functions/$function_sub_directory/$function_name.php";

        return $function_config_filename;
    }

    function get_function_manual_basename($function_name)
    {
        $function_manual_basename = str_replace('_', '-', $function_name);

        return $function_manual_basename;
    }

    function get_function_manual_pagename($function_name)
    {
        $function_manual_basename = $this->get_function_manual_basename($function_name);
        $function_manual_pagename = __DIR__ . "/../public/manual/en/function.$function_manual_basename.html";

        if (! file_exists($function_manual_pagename)) {
            throw new Exception("invalid manual page: function.$function_manual_basename.html");
        }

        return $function_manual_pagename;
    }

    function get_function_list_manual_pagenames($function_list)
    {
        $function_names = explode(',', $function_list);
        $function_manual_pagenames = array_map([$this, 'get_function_manual_pagename'], $function_names);

        return array_combine($function_names, $function_manual_pagenames);
    }

    function get_function_pattern_manual_pagenames($function_pattern)
    {
        $function_manual_basename_pattern = $this->get_function_manual_basename($function_pattern);

        if (! $function_manual_pagenames = glob(__DIR__ . "/../public/manual/en/function.$function_manual_basename_pattern.html")) {
            throw new Exception('no function matching this pattern');
        }

        foreach ($function_manual_pagenames as $file_name) {
            $basename = basename($file_name, '.html');
            list(, $function_name) = explode('.', $basename);
            $function_names[] =  str_replace('-', '_', $function_name);
        }

        return array_combine($function_names, $function_manual_pagenames);
    }

    function get_function_manual_pagenames($functions)
    {
        if (strpos($functions, '*') !== false) {
            $function_manual_pagenames = $this->get_function_pattern_manual_pagenames($functions);
        } else {
            $function_manual_pagenames = $this->get_function_list_manual_pagenames($functions);
        }

        return $function_manual_pagenames;
    }

    function get_help()
    {
        $help_message =
'
config_function <c|r> <function-name|function-list|function-pattern>

Usage:
-c               Create the function config.
-r               Replace the function config.
                 Use with caution as any manual changes in the config file
                 will be replaced as well.

function-name    A function name, eg "abs"
function-list    A comma separated list of functions, eg "sin,cos,tan"
function-pattern A function pattern to match, eg "ctype_*"

Examples:
config_function -c abs
config_function -r sort
config_function -c sin,cos,tan
config_function -c ctype_*
';

        return $help_message;
    }

    function function_config_not_exits($function_config_filename)
    {
        if (file_exists($function_config_filename)) {
            throw new Exception("function already configured: $function_config_filename");
        }
    }

    function make_function_config($option, $function_name, $function_manual_pagename)
    {
        $function_config_filename = $this->get_function_config_filename($function_name);

        if ($option == 'c' and file_exists($function_config_filename)) {
            return "the function is already configured: $function_name";

        }

        if (! $html = file_get_contents($function_manual_pagename)) {
            throw new Exception("cannot read the manual page: $function_manual_pagename");
        }

        $config = $this->create_function_config($function_name, $html);
        $this->write_function_config($function_config_filename, $config);

        return $config;
    }

    function make_functions_configs($option, $functions)
    {
        $option = ltrim($option, '-');

        if ($option == 'h') {
            throw new Exception($this->get_help());
        }

        if (! in_array($option, ['c', 'r'])) {
            throw new Exception('bad option');
        }

        $function_manual_pagenames = $this->get_function_manual_pagenames($functions);

        foreach ($function_manual_pagenames as $function_name => $function_manual_pagename) {
            $configs[] = $this->make_function_config($option, $function_name, $function_manual_pagename);
        }

        return $configs;
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

        if (! preg_match_all('~(\(?' . $function_name . '\s*\(.+?)\)(;| ==| as| .)~s', $string, $matches)) {
            // no function calls, ex. array_diff($array1, $array2);
            return array();
        }

        list(, $function_calls) = $matches;

        foreach($function_calls as &$function_call) {
            if ($function_call[0] == '(') {
                // the function is called within another function, ex. print_r()
                // ex. print_r(array_change_key_case($input_array, CASE_UPPER));
                $function_call = substr($function_call, 1);

                if (substr($function_call, -1) == ')') {
                    // removes the function right parenthesis
                    $function_call = substr($function_call, 0, -1);
                }
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

    function write_function_config($function_config_filename, $config)
    {
        $directory = dirname($function_config_filename);

        if (! is_dir($directory) and ! mkdir($directory)) {
            throw new Exception("cannot create directory: $directory");
        }

        if (! file_put_contents($function_config_filename, $config)) {
            throw new Exception("cannot write function config: $function_config_filename");
        }
    }
}
