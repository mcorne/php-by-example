<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class strftime extends function_core
{
    public $source_code = '
date_default_timezone_set ("UTC");
$_timestamp = strtotime(
    $time // string $time
);
inject_function_call
';

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

    public $synopsis = 'string strftime ( string $format [, int $timestamp = time() ] )';

    function pre_exec_function()
    {
        $time = $this->_filter->filter_arg_value('time');
        $this->returned_params['timestamp'] = strtotime($time);
    }
}
