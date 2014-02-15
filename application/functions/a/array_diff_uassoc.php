<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_diff_uassoc extends function_core
{
    public $source_code = '
$_key_compare_func = function ($a, $b) {
    if ($a === $b) { return 0; }
    return ($a > $b)? 1 : -1;
};
inject_function_call
';

    public $examples = [
        [
            [
                "a" => "green",
                "b" => "brown",
                "c" => "blue",
                "red"
            ],
            [
                "a" => "green",
                "yellow",
                "red"
            ],
            '$key_compare_func',
        ],
        [
            [
                "a" => 1,
                "b" => 2,
                "c" => 3,
            ],
            [
                "a" => 2,
                "c" => "3",
            ],
            'gmp_cmp',
        ],
    ];

    public $helper_callbacks = ['index_in_example' => 2, 'function_name_pattern' => '~(cmp$)~'];

    public $synopsis = 'array array_diff_uassoc ( array $array1 , array $array2 [, array $... ], callable $key_compare_func )';

    function pre_exec_function()
    {
        $this->returned_params['key_compare_func'] = $this->_filter->filter_callback('key_compare_func');
    }
}