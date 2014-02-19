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
 * arg value filters
 * a filter is meant to called from the pre_exec() method in a function config
 * there is a default filter to use as needed: filter_arg_value()
 */

class filter extends object
{
    const DEFAULT_FILE_NAME = 'tempname';

    function filter_arg_value($arg_name)
    {
        if ($this->_params->param_exists($arg_name)) {
            $array = $this->_params->get_param($arg_name);

        } else {
            $array = null;
        }

        return $array;
    }

    function filter_callback($arg_name)
    {
        if (! $this->_params->param_exists($arg_name)) {
             return null;
        }

        $closure_var_name = $this->_params->get_param($arg_name, false);

        if (is_null($closure_var_name)) {
            return null;
        }

        $available_closures = [
            '$cb1'                => function ($a)                     { return array ($a); },
            '$cb2'                => function ($a, $b)                 { return array ($a, $b); },
            '$compare_func'       => function($a, $b)                  { if ($a === $b) { return 0; } return ($a > $b)? 1 : -1; },
            '$cube'               => function ($n)                     { return($n * $n * $n); },
            '$double'             => function($value)                  { return $value * 2; },
            '$even'               => function($var)                    { return(!($var & 1)); },
            '$map_Spanish'        => function ($n, $m)                 { return(array($n => $m)); },
            '$next_year'          => function ($matches)               { return $matches[1] . ($matches[2] + 1); },
            '$odd'                => function($var)                    { return($var & 1); },
            '$rmul'               => function ($v, $w)                 { $v *= $w; return $v; },
            '$rsum'               => function ($v, $w)                 { $v += $w; return $v; },
            '$show_Spanish'       => function ($n, $m)                 { return("The number $n is called $m in Spanish"); },
            '$test_alter'         => function (&$item1, $key, $prefix) { $item1 = "$prefix: $item1"; },
            '$test_print'         => function (&$item, $key)           { $item = "$key holds $item\n"; },
            '$to_lower'           => function ($matches)               { return strtolower($matches[0]); },
        ];

        if ($this->_params->is_param_var($closure_var_name)) {
            // the callback is a variable set to a closure, returns wether the closure is in the list of available closures or not
            return isset($available_closures[$closure_var_name]) ? $available_closures[$closure_var_name] : null;
        }

        $callback_function_name =  $this->_params->get_param($arg_name);

        if (! function_exists($callback_function_name)) {
            $message = $this->_translation->translate('the callback function is invalid or not available on this server');
            throw new Exception($message, E_USER_WARNING);
        }

        $valid_callback_functions = '~(cmp$|^ctype_|^gmp|^is_|^str[ifprst])~';

        if (! is_string($callback_function_name) or ! preg_match($valid_callback_functions, $callback_function_name)) {
            $message = $this->_translation->translate('this callback function may not be used in this example');
            throw new Exception($message, E_USER_WARNING);
        }

        return $callback_function_name;
    }

    function filter_date_interval($arg_name)
    {
        if ($this->_params->param_exists($arg_name)) {
            $interval_spec = $this->_params->get_param($arg_name);
            $interval = new DateInterval($interval_spec);

        } else {
            $interval = new DateInterval();
        }

        return $interval;
    }

    function filter_date_time($arg_name)
    {
        if ($this->_params->param_exists($arg_name)) {
            $time = $this->_params->get_param($arg_name);
            $date = new DateTime($time);

        } else {
            $date = new DateTime();
        }

        return $date;
    }

    function filter_file_length($arg_name, $filename)
    {
        $length = $this->_params->get_param($arg_name);

        if (preg_match('~^https?://~', $filename) and (is_null($length) or is_numeric($length) and $length > 1000)) {
            // the file is external and the length is null or too large
            $message = $this->_translation->translate('the length must be defined and lower than 1000 bytes in this example', '$' . $arg_name);
            throw new Exception($message, E_USER_WARNING);
        }

        return $length;
    }

    function filter_filename($arg_name, $is_temp_file_allowed = false)
    {
        if (! $this->_params->param_exists($arg_name)) {
             return null;
        }

        $filename = $this->_params->get_param($arg_name);

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
            $message = $this->_translation->translate('the filename must start with one of the following strings in this example')
                     . " (http://, https://)";
            throw new Exception($message, E_USER_WARNING);
        }

        if ($filename == self::DEFAULT_FILE_NAME or stripos($filename, $this->_file->temp_file_prefix) === 0) {
            // the file name is a placeholder or a valid temp file prefixed with pbe, forces the file name to the new temp name
            $filename = $this->_file->create_temp_file();
            $this->_file->write_content($filename, "Hello world !");
            $this->_params->params[$arg_name] = $this->_converter->convert_value_to_text($filename);

            return $filename;
        }

        $message = $this->_translation->translate('the filename must start with one of the following strings in this example')
                 . " ({$this->_file->temp_file_prefix}, http://, https://)";
        throw new Exception($message, E_USER_WARNING);
    }

    function filter_iteration_count($arg_name)
    {
        if (! $this->_params->param_exists($arg_name)) {
             return null;
        }

        $count = $this->_params->get_param($arg_name);

        if (! is_int($count) or $count > 10) {
            // the number of iterations is not an integer or too large
            $arg_name = preg_replace('~^_+~', '', $arg_name);
            $message = $this->_translation->translate('the number of iterations must be an integer lower than 10 in this example', '$' . $arg_name);
            throw new Exception($message, E_USER_WARNING);
        }

        return $count;
    }

    function is_allowed_arg_value($arg_name, $allowed_values = [], $is_empty_arg_allowed = true)
    {
        if (! $this->_params->param_exists($arg_name)) {
            if (! $is_empty_arg_allowed) {
                $message = $this->_translation->translate('this argument may not be empty in this example', '$' . $arg_name);
                throw new Exception($message, E_USER_WARNING);
            }

            return;
        }

        $value = $this->_params->get_param($arg_name);

        if (! is_null($value) and ! in_array($value, (array) $allowed_values, true)) {
            $message = $this->_translation->translate('this argument value is not allowed in this example', '$' . $arg_name);
            throw new Exception($message, E_USER_WARNING);
        }
    }
}
