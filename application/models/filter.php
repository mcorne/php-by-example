<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class filter extends object
{
    const DEFAULT_FILE_NAME = 'tempname';

    function compare_func($a, $b)
    {
        if ($a === $b) {
            return 0;
        }

        return ($a > $b)? 1 : -1;
    }

    function filter_param($arg_name)
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
            '$cb1'              => function ($a)     { return array ($a); },
            '$cb2'              => function ($a, $b) { return array ($a, $b); },
            '$cube'             => function ($n)     { return($n * $n * $n); },
            '$double'           => function($value)  { return $value * 2; },
            '$even'             => function($var)    { return(!($var & 1)); },
            '$key_compare_func' => function($a, $b)  { if ($a === $b) { return 0; } return ($a > $b)? 1 : -1; },
            '$map_Spanish'      => function ($n, $m) { return(array($n => $m)); },
            '$odd'              => function($var)    { return($var & 1); },
            '$show_Spanish'     => function ($n, $m) { return("The number $n is called $m in Spanish"); },
        ];

        if ($this->_params->is_param_var($closure_var_name)) {
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

    function filter_ignored_param($arg_name)
    {
        if (! $this->_params->param_exists($arg_name)) {
            return;
        }

        $value = $this->_params->get_param($arg_name);

        if (! is_null($value)) {
            $this->_params->params[$arg_name] = $this->_converter->convert_value_to_text(null);
            $message = $this->_translation->translate('this parameter is ignored in this example') . " (\$$arg_name)";
            trigger_error($message, E_USER_NOTICE);
        }
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

    function filter_filename($arg_name)
    {
        if (! $this->_params->param_exists($arg_name)) {
             return null;
        }

        $filename = $this->_params->get_param($arg_name);

        if (! is_string($filename)) {
            // the file name is not a string, this will be caught by the function itself

        } else if ($filename == self::DEFAULT_FILE_NAME or stripos($filename, $this->_file->temp_file_prefix) === 0) {
            // the file name is a placeholder or a valid temp file prefixed with pbe, forces the file name to the new temp name
            $filename = $this->_file->create_temp_file();
            $this->_file->write_content($filename, "Hello world !");
            $this->_params->params[$arg_name] = $this->_converter->convert_value_to_text($filename);;

        } else if (stripos($filename, 'http://') === 0 or stripos($filename, 'https://') === 0) {
            // the file name is a valid http file

        } else {
            $message = $this->_translation->translate('the filename must start with one of the following strings in this example')
                     . " ({$this->_file->temp_file_prefix}, http://)";
            throw new Exception($message, E_USER_WARNING);
        }


        return $filename;
    }
}
