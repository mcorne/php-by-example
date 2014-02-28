<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class uasort extends function_core
{
    public $source_code = '
$_array =
    $__array; // array $__array
$_compare_func = function ($a, $b) {
    if ($a === $b) { return 0; }
    return ($a > $b)? 1 : -1;
};
inject_function_call
';

    public $examples = [
        [
            '__array' => [
                "a" => 4,
                "b" => 8,
                "c" => -1,
                "d" => -9,
                "e" => 2,
                "f" => 5,
                "g" => 3,
                "h" => -4,
            ],
            '$array',
            '$compare_func',
        ]
    ];

    public $helper_callbacks = ['index_in_example' => 1, 'function_name_pattern' => '~(cmp$)~'];

    public $synopsis = 'bool uasort ( array &$array , callable $value_compare_func )';

    function pre_exec_function()
    {
        $this->returned_params['value_compare_func'] = $this->_filter->filter_callback('value_compare_func');
    }
}