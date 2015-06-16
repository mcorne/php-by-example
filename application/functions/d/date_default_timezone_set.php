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

class date_default_timezone_set extends function_core
{
    public $examples = ["America/Los_Angeles"];

    public $options_getter = [
        'timezone_identifier' => ['DateTimeZone', 'listIdentifiers'],
    ];

    public $source_code = '
        inject_function_call

        // shows the default timezone
        $default_timezone = date_default_timezone_get();
    ';

    public $synopsis = 'bool date_default_timezone_set ( string $timezone_identifier )';

    function post_exec_function()
    {
        $this->result['default_timezone'] = date_default_timezone_get();
    }
}
