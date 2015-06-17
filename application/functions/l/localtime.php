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
 * @see docs/function-configuration.txt
 */

class localtime extends function_core
{
    public $examples = [
        [
            'timezone'    => 'UTC',
            'time'        => "2000-01-01 12:00:00",
            '$timestamp',
        ],
        [
            'timezone'    => 'UTC',
            'time'        => "2000-01-01 12:00:00",
            '$timestamp',
            true,
        ],
        [
            'timezone'    => 'UTC',
            'time'        => '',
            946728000, // 2000-01-01 12:00:00
            true,
        ],
        [
            'timezone'    => 'UTC',
            'time'        => '',
        ],
    ];

    public $input_args = ['timezone'];

    public $options_getter = [
        'timezone' => ['DateTimeZone', 'listIdentifiers'],
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

    public $synopsis = 'array localtime ([ int $timestamp = time() [, bool $is_associative = false ]] )';

    public $test_not_validated = 3;

    function pre_exec_function()
    {
        if ($timezone = $this->_filter->filter_arg_value('timezone')) {
            date_default_timezone_set($timezone);
        }

        if ($time = $this->_filter->filter_arg_value('time')) {
            $this->returned_params['timestamp'] = strtotime($time);
        }
    }
}
