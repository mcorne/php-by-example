<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_reduce extends function_core
{
    public $source_code = '
$rsum = function ($v, $w) { $v += $w; return $v; };
$rmul = function ($v, $w) { $v *= $w; return $v; };
inject_function_call
';

    public $examples = [
        [
            [1, 2, 3, 4, 5],
            '$rsum',
        ],
        [
            [1, 2, 3, 4, 5],
            '$rmul',
            10
        ],
        [
            [],
            '$rsum',
            "No data to reduce"
        ],
    ];

    public $synopsis = 'mixed array_reduce ( array $array , callable $callback [, mixed $initial = NULL ] )';

    function pre_exec_function()
    {
        $this->returned_params['callback'] = $this->_filter->filter_callback('callback');
    }
}
