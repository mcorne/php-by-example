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

    function filter_callback_compare($arg_name)
    {
        static $callbacks = ['$key_compare_func', 'strcmp', 'gmp_cmp', 'strnatcmp', 'strcasecmp', 'variant_cmp', 'strnatcasecmp'];

        if (! $this->_params->param_exists($arg_name)) {
             return null;
        }

        if ($this->_params->params[$arg_name] == '$key_compare_func') {
            $callback = [$this, 'compare_func'];

        } else {
            $callback =  $this->_params->get_param($arg_name);

            if (! in_array($callback, $callbacks)) {
                $message = $this->_translation->translate('the callback function must be one of the following functions')
                         . ' (' . implode(', ' , $callbacks) . ')';
                throw new Exception($message, E_USER_WARNING);
            }
        }

        return $callback;
    }

    function filter_callback_is_function($arg_name)
    {
        $even = function($var){ return(!($var & 1)); };
        $odd = function($var){ return($var & 1); };

        if (! $this->_params->param_exists($arg_name)) {
             return null;
        }

        if ($this->_params->params[$arg_name] == '$even') {
            $callback = $even;

        } else if ($this->_params->params[$arg_name] == '$odd') {
            $callback = $odd;

        } else {
            $callback =  $this->_params->get_param($arg_name);

            if (strpos($callback, 'is_') !== false and strpos($callback, 'ctype_') !== false) {
                $message = $this->_translation->translate('the callback function must be one of the following functions')
                         . ' ($even, $odd, is_*, ctype_*)';
                throw new Exception($message, E_USER_WARNING);
            }
        }

        return $callback;
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
