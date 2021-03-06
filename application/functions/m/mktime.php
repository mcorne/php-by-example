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

class mktime extends function_core
{
    public $examples = [
        ['timezone' => 'UTC', 0, 0, 0, 7, 1, 2000],
        ['timezone' => 'UTC', 1, 2, 3, 4, 5, 2006],
        ['timezone' => 'UTC', 0, 0, 0, 12, 32, 1997],
        ['timezone' => 'UTC', 0, 0, 0, 13, 1, 1997],
        ['timezone' => 'UTC', 0, 0, 0, 1, 1, 1998],
        ['timezone' => 'UTC', 0, 0, 0, 1, 1, 98],
        ['timezone' => 'UTC', 0, 0, 0, 3, 0, 2000],
        ['timezone' => 'UTC', 0, 0, 0, 4, -31, 2000]
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

    public $synopsis       = 'int mktime ([ int $hour = date(&quot;H&quot;) [, int $minute = date(&quot;i&quot;) [, int $second = date(&quot;s&quot;) [, int $month = date(&quot;n&quot;) [, int $day = date(&quot;j&quot;) [, int $year = date(&quot;Y&quot;) [, int $is_dst = -1 ]]]]]]] )';
    public $synopsis_fixed = 'int mktime ([ int $hour ) [, int $minute ) [, int $second ) [, int $month ) [, int $day ) [, int $year ) [, int $is_dst = -1 ]]]]]]] )';

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
