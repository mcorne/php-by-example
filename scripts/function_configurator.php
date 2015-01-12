<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/object.php';

/**
 * function configurator
 *
 * creates a function configuration file in the "functions" directory to be adjusted manually as needed
 * see get_help()
*/
class function_configurator extends object
{
    // the characters before or after a function call in an example may be adjusted as needed, see parse_function_calls()
    // adjust with caution
    public $chars_before_function = '(,!=';
    public $chars_after_function  = ';=a{\.\?';

    function assign_values_to_args($function_call, $args, $function_name)
    {
        try {
            $params = [];
            $arg_names = array_keys($args);

            if ($function_name == 'array') {
                // this is the array() pseudo function, encloses the function call into an array
                $function_call = "array($function_call)";
            }

            if ($values = $this->_parser->parse_value("array($function_call)", $function_name, false)) {
                foreach ($values as $index => $value)  {
                    if (isset($arg_names[$index])) {
                        $arg_name = $arg_names[$index];
                        $params[$arg_name] = $value;
                    }
                }
            }

        } catch (Exception $e) {
        }

        return $params;
    }

    function convert_method_name($function_name)
    {
        $function_name = str_replace('.', '__', $function_name);

        return $function_name;
    }

    function create_function_alias_config($alias_function_name, $original_function_name)
    {
        $format =
'<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once \'%1$s%2$s.php\';

class %3$s extends %2$s
{
    public $synopsis = \'%4$s\';
}
';

        $function_config_filename = $this->get_function_config_filename($original_function_name);

        if (! file_exists($function_config_filename) or ! $config = file_get_contents($function_config_filename)) {
            return null;
        }

        $original_function_sub_directory = $original_function_name[0];

        if ($original_function_sub_directory != $alias_function_name[0]) {
            // the original function is in a different directory, prefixes the include file name
            $include_file_prefix = "functions/$original_function_sub_directory/";
        } else {
            $include_file_prefix = null;
        }

        if (! preg_match('~public +\$synopsis += +\'(.+)\';~', $config, $match)) {
            throw new Exception("cannot parse function config synopsis for: $original_function_name");
        }

        $synopsis = str_replace($original_function_name, $alias_function_name, $match[1]);
        $config = sprintf($format, $include_file_prefix, $original_function_name, $alias_function_name, $synopsis);

        return $config;
    }

    function create_function_config($function_name, $html, $synopsis, $synopsis_fixed = null)
    {
        $format =
'<?php
/**
 * PHP By Example
 *
 * @copyright %s Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once \'models/function_core.php\';

class %s extends function_core
{
    %s%s
}
';

        $args = $this->parse_args($synopsis_fixed ?: $synopsis, $function_name);

        if ($examples = $this->parse_examples($html, $function_name, $args)) {
            $exported_examples = $this->export_examples($examples);
            $examples_property = sprintf("public \$examples = [%s];\n\n    ", $exported_examples);

        } else {
            $examples_property = null;
        }

        if ($synopsis_fixed) {
            $synopsis_property = $this->create_synopsis_fixed_properties($synopsis, $synopsis_fixed);
        } else {
            $synopsis_property = $this->create_synopsis_property($synopsis);
        }

        $function_name = $this->convert_method_name($function_name);
        $config = sprintf($format, date('Y'), $function_name, $examples_property, $synopsis_property);

        return $config;
    }

    function create_synopsis_fixed_properties($synopsis, $synopsis_fixed)
    {
        $format =
'public $synopsis       = \'%s\';
    public $synopsis_fixed = \'%s\';';
        $synopsis_properties = sprintf($format, $synopsis, $synopsis_fixed);

        return $synopsis_properties;
    }

    function create_synopsis_property($synopsis)
    {
        $format = 'public $synopsis = \'%s\';';
        $synopsis_property = sprintf($format, $synopsis);

        return $synopsis_property;
    }

    function display_configs($configs)
    {
        $configs = "\n" . implode("\n\n", $configs);

        return $configs;
    }

    function export_example($example)
    {
        $example_values = [];
        $has_array_value = false;

        foreach ($example as $example_value) {
            $text = $this->_converter->convert_value_to_text($example_value, false, true, false, '    ');

            if (is_array($example_value)) {
                // this example has multiple arg values (array of values), formats the example
                // left justified the array lines
                $text = str_replace("\n", "\n            ", $text);
                $has_array_value = true;
            }

            $example_values[] = $text;
        }

        $example_values = implode(",\n            ", $example_values);

        if (count($example) != 1 or $has_array_value) {
            // there is more than one example or at least one example has multiple arg values
            $example_values = "[\n            $example_values\n        ]";
        }

        return $example_values;
    }

    function export_examples($examples)
    {
        $has_multi_value_example = false;

        foreach ($examples as $example) {
            $example_values = $this->export_example($example);
            $examples_values[] = $example_values;

            if ($example_values[0] == '[') {
                $has_multi_value_example = true;
            }
        }

        if ($has_multi_value_example) {
            $examples_values = "\n        " . implode(",\n        ", $examples_values) . "\n    ";
        } else {
            $examples_values = implode(', ', $examples_values);
        }

        return $examples_values;
    }

    function get_function_config_filename($function_name)
    {
        $function_sub_directory = $function_name[0];
        $function_name = $this->convert_method_name($function_name);
        $function_config_filename = __DIR__ . "/../application/functions/$function_sub_directory/$function_name.php";

        return $function_config_filename;
    }

    function get_function_list_manual_pagenames($function_list)
    {
        $function_names = explode(',', $function_list);
        $function_manual_pagenames = @array_map([$this, 'get_function_manual_pagename'], $function_names);

        return array_combine($function_names, $function_manual_pagenames);
    }

    function get_function_manual_basename($function_name)
    {
        $function_manual_basename = str_replace('_', '-', $function_name);
        $function_manual_basename = strtolower($function_manual_basename);

        return $function_manual_basename;
    }

    function get_function_manual_pagename($function_name)
    {
        if (preg_match('~^(\w+)\.(\w+)$~', $function_name, $match)) {
            list(, $class_name, $function_name) = $match;

        } else{
            $class_name = 'function';
        }

        $function_manual_basename = $this->get_function_manual_basename($function_name);
        $function_manual_pagename = __DIR__ . "/../public/manual/en/$class_name.$function_manual_basename.html";

        if (! file_exists($function_manual_pagename)) {
            throw new Exception("invalid manual page: function.$function_manual_basename.html");
        }

        return $function_manual_pagename;
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

    function get_function_pattern_manual_pagenames($function_pattern)
    {
        $function_manual_basename_pattern = $this->get_function_manual_basename($function_pattern);

        if (! $function_manual_pagenames = glob(__DIR__ . "/../public/manual/en/function.$function_manual_basename_pattern.html")) {
            throw new Exception('no function matching this pattern');
        }

        foreach ($function_manual_pagenames as $filename) {
            $basename = basename($filename, '.html');
            list(, $function_name) = explode('.', $basename);
            $function_names[] =  str_replace('-', '_', $function_name);
        }

        return array_combine($function_names, $function_manual_pagenames);
    }

    function get_help()
    {
        $help_message =
'
Usage:
config_function <c|r> <function-name|function-list|function-pattern> [synopsis-fixed]

-c               Create the function config.
-r               Replace the function config.
                 Use with caution as any manual changes in the config file
                 will be replaced as well.

function-name    A function name, eg "abs" or "pdo.query".
function-list    A comma separated list of functions, eg "sin,cos,tan".
function-pattern A function pattern to match, eg "ctype_*".
                 Not available for class methods.

synopsis-fixed   The fixed sysnopsis,
                 eg "string sprintf ( string $format , mixed $arg0 , mixed $arg1 [, mixed $... ] )"

Examples:
config_function -c abs
config_function -c pdo.query
config_function -r sort
config_function -c sin,cos,tan
config_function -c ctype_*
config_function -r sprintf "string sprintf ( string $format , mixed $arg0 , mixed $arg1 [, mixed $... ] )"
';

        return $help_message;
    }

    function make_function_config($option, $function_name, $function_manual_pagename, $synopsis_fixed = null)
    {
        $function_config_filename = $this->get_function_config_filename($function_name);

        if ($option == 'c' and file_exists($function_config_filename)) {
            return "the function is already configured: $function_name";
        }

        if (! $html = file_get_contents($function_manual_pagename)) {
            throw new Exception("cannot read the manual page: $function_manual_pagename");
        }

        if ($synopsis = $this->parse_synopsis($html)) {
            $config = $this->create_function_config($function_name, $html, $synopsis, $synopsis_fixed);

        } else if ($original_function_name = $this->parse_function_alias($html)) {
            if (! $config = $this->create_function_alias_config($function_name, $original_function_name)) {
                return "cannot configure function alias: $function_name, config missing for: $original_function_name";
            }

        } else {
            return "cannot parse synopsis or alias for: $function_name";
        }

        $this->write_function_config($function_config_filename, $config);

        return $config;
    }

    function make_functions_configs($option, $functions, $synopsis_fixed = null)
    {
        date_default_timezone_set('UTC');
        $option = ltrim($option, '-');

        if (! in_array($option, ['c', 'r'])) {
            throw new Exception($this->get_help());
        }

        $function_manual_pagenames = $this->get_function_manual_pagenames($functions);

        foreach ($function_manual_pagenames as $function_name => $function_manual_pagename) {
            $configs[] = $this->make_function_config($option, $function_name, $function_manual_pagename, $synopsis_fixed);
        }

        return $configs;
    }

    function parse_args($synopsis, $function_name)
    {
        if ($function_name == 'array') {
            // this is the array() pseudo function, forces the param to $array as it is used as such in the sort() like functions
            $params = ['array' => '$array'];

        } else if (preg_match_all('~&?\$(\w+)~', $synopsis, $matches)) {
            // the function has arguments, ex. $bar, &$baz
            list($params_names, $vars_names) = $matches;
            $params = array_combine($params_names, $vars_names);

        } else {
            // the function has no arguments
            $params = [];
        }

        return $params;
    }

    function parse_example($example, $function_name, $args, &$vars_values)
    {
        $example = $this->strip_example($example, $function_name);

        if ($function_calls = $this->parse_function_calls($example, $function_name)) {
            $vars_values = $this->parse_vars_values($example) + $vars_values;
            $function_calls = $this->replace_functions_vars_with_values($function_calls, $vars_values, $args, $function_name);
        }

        return $function_calls;
    }

    function parse_examples($html, $function_name, $args)
    {
    	if (! preg_match_all('~<div class="example-contents">(.*?)</div>~s', $html, $matches)) {
    		return null;
    	}

    	list(, $examples) = $matches;
    	$function_calls = [];
    	$vars_values = [];

    	foreach ($examples as $example) {
            $function_calls = array_merge($function_calls, $this->parse_example($example, $function_name, $args, $vars_values));
    	}

    	return array_filter($function_calls);
    }

    function parse_function_alias($html)
    {
        if (preg_match('~This function is an alias of:.*?class="function">(\w+)\(\)~s', $html, $match)) {
            $original_function_name = $match[1];
        } else {
            $original_function_name = null;
        }

        return $original_function_name;
    }

    function parse_function_calls($string, $function_name)
    {
        $function_calls = [];

        if (! preg_match_all("~((?:[{$this->chars_before_function}] ?)?$function_name\s*\(.+?)\)( ?[{$this->chars_after_function}])~s", $string, $matches)) {
            // no function calls, ex. array_diff($array1, $array2);
            return [];
        }

        list(, $function_calls) = $matches;

        foreach ($function_calls as &$function_call) {
            if (preg_match("~[{$this->chars_before_function}]~", $function_call[0])) {
                // the function is called within another function, ex. print_r()
                // ex. print_r(array_change_key_case($input_array, CASE_UPPER));
                $function_call = ltrim($function_call, " {$this->chars_before_function}");

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

    function parse_synopsis($html)
    {
        if (! preg_match('~<div class="methodsynopsis dc-description">(.+?)</div>~s', $html, $match)) {
            return null;
        }

        // strips tags and extra spaces
        $synopsis = strip_tags($match[1]);
        $synopsis = preg_replace('~\s+~', ' ', $synopsis);
        $synopsis = trim($synopsis);

        return $synopsis;
    }

    function parse_vars_values($string)
    {
    	if ( ! preg_match_all('~(\$\w+)\s*=\s*(.+?);~s', $string, $matches)) {
    		return [];
    	}

    	list(, $names, $values) = $matches;
    	$vars_values = array_combine($names, $values);

    	return $vars_values;
    }

    function replace_function_vars_with_values($function_call, $vars_values)
    {
        if (preg_match_all('~\$\w+~s', $function_call, $matches)) {
            list($vars) = $matches;

            foreach ($vars as $var) {
                if (isset($vars_values[$var])) {
                    $function_call = str_replace($var, $vars_values[$var], $function_call);
                } else {
                    $function_call = str_replace($var, '', $function_call);
                }
            }
        }

        return $function_call;
    }

    function replace_functions_vars_with_values($function_calls, $vars_values, $args, $function_name)
    {
        foreach ($function_calls as &$function_call) {
            $function_call = $this->replace_function_vars_with_values($function_call, $vars_values);
            $function_call = $this->assign_values_to_args($function_call, $args, $function_name);
        }

        return $function_calls;
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
        // removes PHP comments /*...*/
        $html = preg_replace('~/\*.+?\*/~s', '', $html);
        // removes PHP comments //..., excluding urls's ...://... as in "http://..."
        $html = preg_replace('~(?<!:)//.+?$~m', '', $html);
        // removes function call return variables, ex. $abs in $abs = abs(...)
        $html = preg_replace('~(\$\w+\s*=\s*)(?=' . $function_name . '\()~s', '', $html);

        return $html;
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
