<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class strftime extends function_core
{
    public $examples = [
        [
            'time' => "12/28/2002",
            "%U,%Y",
            '$timestamp',
        ],
        [
            'time' => "12/30/2002",
            "%U,%Y",
            '$timestamp',
        ],
        [
            'time' => "1/3/2003",
            "%U,%Y",
            '$timestamp',
        ],
        [
            'time' => "1/10/2003",
            "%U,%Y",
            '$timestamp',
        ],
    ];

    public $source_code = '
        date_default_timezone_set("UTC");

        // returns a timestamp from a date
        $_timestamp = strtotime(
            $time // string $time
        );

        inject_function_call

        // enter either a $_time or a timestamp
    ';

    public $synopsis = 'string strftime ( string $format [, int $timestamp = time() ] )';

    function pre_exec_function()
    {
        date_default_timezone_set("UTC");

        $time = $this->_filter->filter_arg_value('time');
        $this->returned_params['timestamp'] = strtotime($time);
    }
}
