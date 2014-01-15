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

    function filter_array()
    {
        if (isset($this->_params->params['__array']) and $this->_params->params['__array'] != '') {
            $array = $this->_params->get_param('__array');

        } else {
            $array = null;
        }

        return $array;
    }

    function filter_callback_compare($arg_name)
    {
        static $callbacks = ['key_compare_func', 'strcmp', 'gmp_cmp', 'strnatcmp', 'strcasecmp', 'variant_cmp', 'strnatcasecmp'];

        if (! isset($this->_params->params[$arg_name]) and $this->_params->params[$arg_name] != '') {
             return null;
        }

        $callback =  $this->_params->get_param($arg_name);

        if (in_array($this->_params->params[$arg_name], ['$key_compare_func'])) {
            $special_param = [$arg_name => [$this, 'compare_func']];

        } else if (in_array($callback, $callbacks)) {
            $special_param = null;

        } else {
            $message = $this->_translation->translate('the callback function must be one of the following functions')
                     . ' (' . implode(', ' , $callbacks) . ')';
            throw new Exception($message, E_USER_WARNING);
        }

        return $special_param;
    }

    function filter_context()
    {
        if (! isset($this->_params->params['context'])) {
            return;
        }

        $context = $this->_params->get_param('context');

        if (! is_null($context)) {
            $this->_params->params['context'] = $this->_converter->convert_value_to_text(null);
            $message = $this->_translation->translate('this parameter is ignored in this example') . ' ($context)';
            trigger_error($message, E_USER_NOTICE);
        }
    }

    function filter_date_interval()
    {
        if (isset($this->_params->params['interval_spec']) and $this->_params->params['interval_spec'] != '') {
            $interval_spec = $this->_params->get_param('interval_spec');
            $interval = new DateInterval($interval_spec);

        } else {
            $interval = new DateInterval();
        }

        return $interval;
    }

    function filter_date_time()
    {
        if (isset($this->_params->params['time']) and $this->_params->params['time'] != '') {
            $time = $this->_params->get_param('time');
            $date = new DateTime($time);

        } else {
            $date = new DateTime();
        }

        return $date;
    }

    function filter_date_format()
    {
        if (isset($this->_params->params['format']) and $this->_params->params['format'] != '') {
            $format = $this->_params->get_param('format');

        } else {
            $format = null;
        }

        return $format;
    }

    function filter_filename()
    {
        if (! isset($this->_params->params['filename']) and $this->_params->params['filename'] != '') {
             return null;
        }

        $filename = $this->_params->get_param('filename');

        if (! is_string($filename)) {
            // the file name is not a string, it will be captured by the function itself

        } else if ($filename == self::DEFAULT_FILE_NAME or stripos($filename, $this->_file->temp_file_prefix) === 0) {
            // the file name is a placeholder or a valid temp file prefixed with pbe, forces the file name to the new temp name
            $filename = $this->_file->create_temp_file();
            $this->_file->write_content($filename, "Hello world !");
            $this->_params->params['filename'] = $this->_converter->convert_value_to_text($filename);;

        } else if (stripos($filename, 'http://') === 0 or stripos($filename, 'https://') === 0) {
            // the file name is a valid http file

        } else {
            $message = $this->_translation->translate('the filename must start with one of the following strings in this example')
                     . " ({$this->_file->temp_file_prefix}, http://)";
            throw new Exception($message, E_USER_WARNING);
        }


        return $filename;
    }

    function filter_fopen_mode()
    {
        if (isset($this->_params->params['mode']) and $this->_params->params['mode'] != '') {
            $mode = $this->_params->get_param('mode');

        } else {
            $mode = null;
        }

        return $mode;
    }

    function filter_use_include_path()
    {
        if (! isset($this->_params->params['use_include_path'])) {
            return;
        }

        $use_include_path = $this->_params->get_param('use_include_path');

        if ($use_include_path) {
            $this->_params->params['use_include_path'] = $this->_converter->convert_value_to_text(null);
            $message = $this->_translation->translate('this parameter is ignored in this example') . ' ($use_include_path)';
            trigger_error($message, E_USER_NOTICE);
        }
    }
}
