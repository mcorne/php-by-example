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

class time extends function_core
{
    public $examples = [
        ['timezone' => "UTC"]
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

        // shows the date in a readable format
        $date = date("c", $int);
    ';

    public $synopsis = 'int time ( void )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        $this->result['date'] = date("c", $this->result['int']);
    }

    function pre_exec_function()
    {
        if ($timezone = $this->_filter->filter_arg_value('timezone')) {
            date_default_timezone_set($timezone);
        }
    }

}
