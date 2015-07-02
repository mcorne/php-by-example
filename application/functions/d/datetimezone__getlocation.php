<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class datetimezone__getlocation extends function_core
{
    public $examples = [
        [
            'timezone' => 'Europe/Prague',
        ],
    ];

    public $input_args = ['timezone'];

    public $options_getter = ['timezone' => 'timezone_identifiers_list'];

    public $source_code = '
        $datetimezone = new DateTimeZone(
            $timezone, // string $timezone
        );

        inject_function_call
    ';

    public $synopsis = 'public array DateTimeZone::getLocation ( void )';

    function pre_exec_function()
    {
        $timezone = $this->_filter->filter_arg_value('timezone');
        $this->result['datetimezone'] = $this->object = new DateTimeZone($timezone);
    }
}
