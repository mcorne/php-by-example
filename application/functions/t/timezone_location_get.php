<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/d/datetimezone__getlocation.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class timezone_location_get extends datetimezone__getlocation
{
    public $examples = [
        [
            'timezone' => 'Europe/Prague',
            '$object',
        ],
    ];

    public $source_code = '
        $_object = new DateTimeZone(
            $timezone // string $timezone
        );

        inject_function_call
    ';

    public $synopsis = 'array timezone_location_get ( DateTimeZone $object )';

    function pre_exec_function()
    {
        $timezone = $this->_filter->filter_arg_value('timezone');

        if (! $this->returned_params['object'] = new DateTimeZone($timezone)) {
            $this->method_to_exec = false;
            return;
        }

        $this->result['datetimezone'] = $this->returned_params['object'];
    }
}
