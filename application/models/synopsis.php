<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * function synopsis parser
 */

class synopsis extends object
{
    function _get_arg_descriptions()
    {
        list(, $function_description) = explode('(', $this->synopsis_fixed, 2);
        $function_description = ltrim($function_description);
        // right trims in 2 steps so it does not affect the last param with a default function, eg "...string $encoding = mb_internal_encoding() ]] )"
        $function_description = rtrim($function_description, ' )');
        $function_description = rtrim($function_description, ' ]');

        $parts = explode('[', $function_description, 2);

        if ($parts[0]) {
            $arg_descriptions = $this->get_mandatory_args_description($parts[0]);
        } else {
            // there is no mandatory args
            $arg_descriptions = [];
        }

        if (isset($parts[1])) {
            // there are optional args, extract the optional args description
            $optional_args_description = $this->get_optional_args_description($parts[1]);
            $arg_descriptions = array_merge($arg_descriptions, $optional_args_description);
        }

        return $arg_descriptions;
    }

    function _get_arg_names()
    {
        if (preg_match_all('~(?<=[a-z] | &)\$([\w]+)~', $this->synopsis_fixed, $matches)) {
            // the function has arguments, extracts the argument names
            $arg_names = $matches[1];
        } else {
            $arg_names = [];
        }

        return $arg_names;
    }
    function _get_function_name()
    {
        if (! $this->synopsis_fixed) {
            return null;
        }

        if (! preg_match('~([\w:]+) \(~', $this->synopsis_fixed, $match)) {
            throw new Exception('cannot get function name');
        }

        $function_name = $match[1];

        return $function_name;
    }

    function _get_manual_function_name()
    {
        $function_name = strtolower($this->function_name);

        if (strpos($function_name, '::')) {
            // this is a class method, replaces "::" with "."
            $manual_function_name = str_replace('::', '.', $function_name);
        } else {
            // this is a function, prepends the function name with "function."
            $manual_function_name = "function.$function_name";
        }

        $manual_function_name = str_replace('_', '-', $manual_function_name);

        return $manual_function_name;
    }

    function _get_method_name()
    {
        if ($pos = strpos($this->function_name, '::')) {
            // this is a class method, extracts the method name
            $method_name = substr($this->function_name, $pos + 2);

        } else {
            // this is a function, the method name is set to the function name
            $method_name = $this->function_name;
        }

        return $method_name;
    }

    function _get_return_var()
    {
        if (preg_match('~^(array|bool|float|int|mixed|number|resource|string|void)~', $this->synopsis_fixed, $match)) {
            // the function returns a value of a given type, extracts the type
            // note that the name of the return var is built by default on the type, eg "$int"
            $return_var = $match[1];
        } else {
            $return_var = null;
        }

        return $return_var;
    }

    function _get_synopsis_fixed()
    {
        if (! isset(self::$objects['function'])) {
            // eg called from the layout to set the onload() when no function is selected
            $synopsis_fixed = null;

        } else if ($this->_function->synopsis_fixed) {
            $synopsis_fixed = $this->_function->synopsis_fixed;

        } else if ($this->_function->synopsis) {
            $synopsis_fixed = $this->_function->synopsis;
            $synopsis_fixed = str_replace('[, array $... ]', '', $synopsis_fixed);
            $synopsis_fixed = str_replace(['&quot;', '&#039;'], ['"', "'"], $synopsis_fixed);

        } else {
            $synopsis_fixed = null;
        }

        return $synopsis_fixed;
    }

    function get_arg_constant_name_prefix($arg_name)
    {
        if (isset($this->_function->constant_prefix[$arg_name])) {
            $constant_prefix = $this->_function->constant_prefix[$arg_name];

        } else if (preg_match('~(int|mixed) \$' . $arg_name . ' = ([A-Z]+)_~', $this->synopsis_fixed, $match)) {
            $constant_prefix = $constant_prefix = $match[2];

        } else {
            $constant_prefix = null;
        }

        return $constant_prefix;
    }

    function get_arg_constant_names($constant_prefix)
    {
        $constant_names = array_keys(get_defined_constants());
        $arg_constant_names = [];

        foreach ($constant_names as $constant_name) {
            if (preg_match('~^' . $constant_prefix . '_~', $constant_name)) {
                $arg_constant_names[] = $constant_name;
            }
        }

        sort($arg_constant_names, SORT_NATURAL | SORT_FLAG_CASE);

        return $arg_constant_names;
    }

    function get_mandatory_args_description($mandatory_args_description)
    {
        $mandatory_args_description = explode(',', $mandatory_args_description);
        $mandatory_args_description = array_map('trim', $mandatory_args_description);

        return $mandatory_args_description;
    }

    function get_optional_args_description($optional_args_description)
    {
        $optional_args_description = ltrim($optional_args_description, ', ');
        $optional_args_description = explode('[,', $optional_args_description);
        $optional_args_description = array_map('trim', $optional_args_description);
        $optional_args_description = array_map(function ($description) { return "[$description]"; }, $optional_args_description);

        return $optional_args_description;
    }

    function is_boolean_arg($arg_name)
    {
        $is_boolean_arg =  preg_match("~bool +\\$$arg_name\b~", $this->synopsis_fixed);

        return $is_boolean_arg;
    }

    function is_input_arg($arg_name)
    {
        $is_input_arg =  preg_match("~(array|callable|bool|float|int|mixed|number|string) +\\$$arg_name~", $this->synopsis_fixed);

        return $is_input_arg;
    }

    function is_reference_arg($arg_name)
    {
        // checks if the arg is prefixed with "&"
        $is_reference_arg = preg_match("~(array|float|int|mixed|string) +&\\$$arg_name~", $this->synopsis_fixed);

        return $is_reference_arg;
    }
}
