<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class strtotime extends function_core
{
    public $examples = [
            "now",
            "10 September 2000",
            "+1 day",
            "+1 week",
            "+1 week 2 days 4 hours 2 seconds",
            "next Thursday",
            "last Monday",
    ];

    public $source_code = '
date_default_timezone_set("UTC");

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
        date_default_timezone_set("UTC");
    }
}
