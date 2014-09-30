<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * arg value filters
 * a filter is meant to called from the pre_exec() method in a function config
 * there is a default filter to use as needed: filter_arg_value()
 */

require_once 'custom-functions/pbx_callbacks.php';

class filter extends object
{
    const DEFAULT_FILENAME = 'tempname';

    function filter_arg_value($arg_name, $indirect_get_param = true)
    {
        if ($this->_function_params->param_exists($arg_name)) {
            $value = $this->_function_params->get_param($arg_name, $indirect_get_param);

        } else {
            $value = null;
        }

        return $value;
    }

    function filter_callback($arg_name, $class_alias = null)
    {
        $this->_function->see_also or $this->_function->see_also = [];
        $this->_function->see_also[] = 'call_user_func';

        if (! $this->_function_params->param_exists($arg_name)) {
             return;
        }

        $callback_name = $this->_function_params->get_param($arg_name, false);

        if (is_null($callback_name)) {
            return;
        }

        if (is_array($callback_name)) {
            $object = $this->filter_method_callback($callback_name, $class_alias);
            $callback_name[0] = $object;

        } else if ($this->_function_params->is_param_var($callback_name)) {
            $callback_name = $this->filter_closure_callback($callback_name);

        } else if (strpos($callback_name, '::')) {
            $callback_name = explode('::', $callback_name);
            $this->filter_method_callback($callback_name, $class_alias);

        } else {
            $this->filter_function_callback($callback_name);
        }

        return $callback_name;
    }

    function filter_closure_callback($closure_name)
    {
        $closure_name = substr($closure_name, 1);

        if ($this->is_custom_callback_function($closure_name) and isset($GLOBALS[$closure_name])) {
            // this is a valid and existing closure, adds a param with the closure
            $this->_function->returned_params[$closure_name] = $GLOBALS[$closure_name];
            return $GLOBALS[$closure_name];
        }

        // else: the closure is an unset variable, this will be caught by the function itself
        return null;
    }

    function filter_date_interval($arg_name)
    {
        if ($this->_function_params->param_exists($arg_name)) {
            $interval_spec = $this->_function_params->get_param($arg_name);
            $interval = new DateInterval($interval_spec);

        } else {
            $interval = new DateInterval();
        }

        return $interval;
    }

    function filter_date_time($arg_name)
    {
        if ($this->_function_params->param_exists($arg_name)) {
            $time = $this->_function_params->get_param($arg_name);
            $date = new DateTime($time);

        } else {
            $date = new DateTime();
        }

        return $date;
    }

    function filter_file_length($arg_name, $filename)
    {
        $length = $this->_function_params->get_param($arg_name);

        if (preg_match('~^https?://~', $filename) and (is_null($length) or is_numeric($length) and $length > 1000)) {
            // the file is external and the length is null or too large
            $message = $this->_message_translation->translate('the length must be defined and lower than 1000 bytes in this example', '$' . $arg_name);
            throw new Exception($message, E_USER_WARNING);
        }

        return $length;
    }

    function filter_filename($arg_name, $is_temp_file_allowed = false)
    {
        if (! $this->_function_params->param_exists($arg_name)) {
             return null;
        }

        $filename = $this->_function_params->get_param($arg_name);

        if (! is_string($filename)) {
            // the file name is not a string, this will be caught by the function itself
            return $filename;
        }

        if (preg_match('~^https?://~', $filename)) {
            // the file name is a valid http file
            return $filename;
        }

        if (! $is_temp_file_allowed) {
            // only http files are allowed
            $message = $this->_message_translation->translate('the filename must start with one of the following strings in this example')
                     . " (http://, https://)";
            throw new Exception($message, E_USER_WARNING);
        }

        if ($filename == self::DEFAULT_FILENAME or stripos($filename, $this->_file->temp_file_prefix) === 0) {
            // the file name is a placeholder or a valid temp file prefixed with pbe, forces the file name to the new temp name
            $filename = $this->_file->create_temp_file();
            $this->_file->write_content($filename, "Hello world !");
            $this->_function_params->params[$arg_name] = $this->_converter->convert_value_to_text($filename);

            return $filename;
        }

        $message = $this->_message_translation->translate('the filename must start with one of the following strings in this example')
                 . " ({$this->_file->temp_file_prefix}, http://, https://)";
        throw new Exception($message, E_USER_WARNING);
    }

    function filter_function_callback($function_name)
    {
        if (! function_exists($function_name)) {
            $message = $this->_message_translation->translate('this callback function is invalid or not available on this server');
            throw new Exception($message, E_USER_WARNING);
        }

        if ($this->is_custom_callback_function($function_name)) {
            return;
        }

        $valid_callback_pattern = '~(cmp$|^ctype_|^gmp|^is_|^str[ifprst])~';

        if (! is_string($function_name) or ! preg_match($valid_callback_pattern, $function_name)) {
            $message = $this->_message_translation->translate('this callback function may not be used in this example');
            throw new Exception($message, E_USER_WARNING);
        }
    }

    function filter_iteration_count($arg_name)
    {
        if (! $this->_function_params->param_exists($arg_name)) {
             return null;
        }

        $count = $this->_function_params->get_param($arg_name);

        if (! is_int($count) or $count > 10) {
            // the number of iterations is not an integer or too large
            $arg_name = preg_replace('~^_+~', '', $arg_name);
            $message = $this->_message_translation->translate('the number of iterations must be an integer lower than 10 in this example', '$' . $arg_name);
            throw new Exception($message, E_USER_WARNING);
        }

        return $count;
    }

    function filter_method_callback($callback_name, $class_alias = null)
    {
        if ($class_alias and ! class_exists($class_alias)) {
            class_alias('pbx_callbacks', $class_alias);
        }

        $class_name = current($callback_name);

        if ($class_name == '$object') {
            // an object is actually passed in the callback, adds a param with the object
            $class_name = $class_alias ? $class_alias : 'pbx_callbacks';
            $object = new $class_name();
            $this->_function->returned_params['object'] = $object;
            return $object;
        }

        if ($class_name[0] != '$' and class_exists($class_name, false) and
            $class_name != 'pbx_callbacks' and (! $class_alias or $class_name != $class_alias))
        {
            // this is a class name and the class exists but is not the custom class or an alias
            $message = $this->_message_translation->translate('this class may not be used in this example');
            throw new Exception($message, E_USER_WARNING);
        }

        // note that if an object, class or method is invalid, this will be caught by the function itself
        return null;
    }

    function filter_var_name($arg_name, $mandatory = true)
    {
        if ($this->_function_params->param_exists($arg_name)) {
            $var_name = $this->_function_params->get_param($arg_name, false);

            if ($this->_function_params->is_param_var($var_name)) {
                return $var_name;
            }
        }

        if ($mandatory) {
            isset($var_name) or $var_name = null;
            $message = $this->_message_translation->translate('this variable name is invalid', $var_name);
            throw new Exception($message, E_USER_ERROR);
        }

        return null;
    }

    function is_allowed_arg_value($arg_name, $allowed_values = [], $is_empty_arg_allowed = true)
    {
        if (! $this->_function_params->param_exists($arg_name)) {
            if (! $is_empty_arg_allowed) {
                $message = $this->_message_translation->translate('this argument may not be empty in this example', '$' . $arg_name);
                throw new Exception($message, E_USER_WARNING);
            }

            return;
        }

        $value = $this->_function_params->get_param($arg_name);

        if (! is_null($value) and ! in_array($value, (array) $allowed_values, true)) {
            $message = $this->_message_translation->translate('this argument value is not allowed in this example', '$' . $arg_name);
            throw new Exception($message, E_USER_WARNING);
        }
    }

    function is_custom_callback_function($function_name)
    {
        $is_custom_callback_function = method_exists('pbx_callbacks', $function_name);

        return $is_custom_callback_function;
    }
}
