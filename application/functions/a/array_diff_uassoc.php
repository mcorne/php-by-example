<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// this class is extended by other classes

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

    // public $synopsis = 'array array_diff_uassoc ( array $array1 , array $array2 [, array $... ], callable $key_compare_func )';
    public $synopsis = 'array array_diff_uassoc ( array $array1 , array $array2 , callable $key_compare_func )';

    function _get_helper_callbacks()
    {
        $callbacks = $this->get_helper_callbacks(2, '~(cmp$)~');

        return $callbacks;
    }

    function pre_exec_function()
    {
        $this->returned_params['key_compare_func'] = $this->_filter->filter_callback('key_compare_func');
    }
}
