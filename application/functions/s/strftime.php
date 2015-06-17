<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
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

class strftime extends function_core
{
    public $examples = [
        [
            'timezone' => 'UTC',
            'time'     => "12/28/2002",
            "%U,%Y",
            '$timestamp',
        ],
        [
            'timezone' => 'UTC',
            'time'     => "12/30/2002",
            "%U,%Y",
            '$timestamp',
        ],
        [
            'timezone' => 'UTC',
            'time'     => "1/3/2003",
            "%U,%Y",
            '$timestamp',
        ],
        [
            'timezone' => 'UTC',
            'time'     => "1/10/2003",
            "%U,%Y",
            '$timestamp',
        ],
    ];

    public $source_code = '
        // enter a $_time or a $_timestamp

        date_default_timezone_set(
            $timezone // string $timezone
        );

        $_timestamp = strtotime(
            $time // string $time
        );

        inject_function_call
    ';

    public $input_args = ['timezone'];

    public $options_getter = [
        'timezone' => ['DateTimeZone', 'listIdentifiers'],
    ];

    public $synopsis = 'string strftime ( string $format [, int $timestamp = time() ] )';

    function pre_exec_function()
    {
        if ($timezone = $this->_filter->filter_arg_value('timezone')) {
            date_default_timezone_set($timezone);
        }

        $time = $this->_filter->filter_arg_value('time');
        $this->returned_params['timestamp'] = strtotime($time);
    }
}
