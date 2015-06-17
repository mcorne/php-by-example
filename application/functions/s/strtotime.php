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
 * @see docs/function-configuration.txt
 */

class strtotime extends function_core
{
    public $examples = [
        [
            'timezone' => 'UTC',
            'now',
        ],
        [
            'timezone' => 'UTC',
            '10 September 2000',
        ],
        [
            'timezone' => 'UTC',
            '+1 day',
        ],
        [
            'timezone' => 'UTC',
            '+1 week',
        ],
        [
            'timezone' => 'UTC',
            '+1 week 2 days 4 hours 2 seconds',
        ],
        [
            'timezone' => 'UTC',
            'next Thursday',
        ],
        [
            'timezone' => 'UTC',
            'last Monday',
        ],
    ];

    public $input_args = ['timezone'];

    public $options_getter = [
        'timezone' => ['DateTimeZone', 'listIdentifiers'],
    ];

    public $source_code = '
        date_default_timezone_set(
            $timezone // string $timezone
        );

        inject_function_call

        // shows the datetime in a readable format
        $date = date("l dS \o\f F Y h:i:s A", $int);
    ';

    public $synopsis = 'int strtotime ( string $time [, int $now = time() ] )';

    public $test_not_validated = [0, 2, 3, 4, 5, 6];

    function post_exec_function()
    {
        $this->result['date'] = date('l dS \o\f F Y h:i:s A', $this->result['int']);
    }

    function pre_exec_function()
    {
        if ($timezone = $this->_filter->filter_arg_value('timezone')) {
            date_default_timezone_set($timezone);
        }
    }
}
