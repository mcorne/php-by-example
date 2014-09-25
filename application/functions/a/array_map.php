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
    public $examples = [
        [
            'cube',
            [1, 2, 3, 4, 5],
        ],
        [
            'double',
            [1, 2, 3, 4, 5],
        ],
        [
            'show_Spanish',
            [1, 2, 3, 4, 5],
            ["uno", "dos", "tres", "cuatro", "cinco"],
        ],
        [
            'map_Spanish',
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
            'cb1',
            ["stringkey" => "value"],
        ],
        [
            'cb2',
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

    public $helper_callbacks = ['index_in_example' => 0, 'function_name_pattern' => '~(^str[ifprst])~'];

    public $source_code = '
        // custom callback functions
        function cube($n)             { return($n * $n * $n); };
        function double($value)       { return $value * 2; };
        function show_Spanish($n, $m) { return("The number $n is called $m in Spanish"); };
        function map_Spanish($n, $m)  { return(array($n => $m)); };
        function cb1($a)              { return array ($a); };
        function cb2($a, $b)          { return array ($a, $b); };

        inject_function_call
    ';

    public $synopsis       = 'array array_map ( callable $callback , array $array1 [, array $... ] )';
    public $synopsis_fixed = 'array array_map ( callable $callback , array $array1 [, array $array2 [, array $array3 ]] )';

    function pre_exec_function()
    {
        $this->_filter->filter_callback('callback');
    }
}
