<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class synopsis extends object
{
    function _get_arg_descriptions()
    {
        list(, $function_description) = explode('(', $this->synopsis, 2);
        $function_description = ltrim($function_description);
        $function_description = rtrim($function_description, '] )');

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
        if (preg_match_all('~(?<=[a-z] | &)\$([\w]+)~', $this->synopsis, $matches)) {
            // the function has arguments, extracts the argument names
            $arg_names = $matches[1];
        } else {
            $arg_names = [];
        }

        return $arg_names;
    }

    function _get_function_name()
    {
        if (! preg_match('~([\w:]+) \(~', $this->synopsis, $match)) {
            throw new Exception('cannot get function name');
        }

        return $match[1];
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
        if (preg_match('~^(array|bool|float|int|mixed|number|resource|string|void)~', $this->synopsis, $match)) {
            // the function returns a value of a given type, extracts the type
            // note that the name of the return var is built by default on the type, eg "$int"
            $return_var = $match[1];
        } else {
            $return_var = null;
        }

        return $return_var;
    }

    function get_arg_constant_names($arg_name)
    {
        if (isset($this->constant_prefix[$arg_name])) {
            $constant_prefix = $this->constant_prefix[$arg_name];

        } else if (preg_match('~(int|mixed) \$' . $arg_name . ' = ([A-Z]+)_~', $this->synopsis, $match)) {
            $constant_prefix = $constant_prefix = $match[2];

        } else {
            return null;
        }

        $constant_names = array_keys(get_defined_constants());
        $arg_constant_names = [];

        foreach ($constant_names as $constant_name) {
            if (preg_match('~^' . $constant_prefix . '_~', $constant_name)) {
                $arg_constant_names[] = $constant_name;
            }
        }

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

    function is_input_arg($arg_name)
    {
        $is_input_arg =  preg_match("~(array|callable|bool|float|int|mixed|number|string) +\\$$arg_name~", $this->synopsis);

        return $is_input_arg;
    }

    function is_reference_arg($arg_name)
    {
        // checks if the arg is prefixed with "&"
        $is_reference_arg = preg_match("~(array|float|int|string) +&\\$$arg_name~", $this->synopsis);

        return $is_reference_arg;
    }
}
