<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_map extends function_core
{
    public $source_code = '
$cube         = function ($n)     { return($n * $n * $n); };
$double       = function($value)  { return $value * 2; };
$show_Spanish = function ($n, $m) { return("The number $n is called $m in Spanish"); };
$map_Spanish  = function ($n, $m) { return(array($n => $m)); };
$cb1          = function ($a)     { return array ($a); };
$cb2          = function ($a, $b) { return array ($a, $b); };
inject_function_call
';

    public $examples = [
        [
            '$cube',
            [1, 2, 3, 4, 5],
        ],
        [
            '$double',
            [1, 2, 3, 4, 5],
        ],
        [
            '$show_Spanish',
            [1, 2, 3, 4, 5],
            ["uno", "dos", "tres", "cuatro", "cinco"],
        ],
        [
            '$map_Spanish',
            [1, 2, 3, 4, 5],
            ["uno", "dos", "tres", "cuatro", "cinco"],
        ],
        [
            null,
            [1, 2, 3, 4, 5],
            ["one", "two", "three", "four", "five"],
            ["uno", "dos", "tres", "cuatro", "cinco"],
        ],
        [
            '$cb1',
            ["stringkey" => "value"],
        ],
        [
            '$cb2',
            ["stringkey" => "value"],
            ["stringkey" => "value"],
        ],
        [
            null,
            ["stringkey" => "value"],
        ],
        [
            null,
            ["stringkey" => "value"],
            ["stringkey" => "value"],
        ],
    ];

    // public $synopsis = 'array array_map ( callable $callback , array $array1 [, array $... ] )';
    public $synopsis = 'array array_map ( callable $callback , array $array1 [, array $array2 [, array $array3 [, array $... ]]] )';

    function pre_exec_function()
    {
        $this->returned_params['callback'] = $this->_filter->filter_callback('callback');
    }
}
