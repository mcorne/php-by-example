<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_udiff_assoc extends function_core
{
    public $examples = [
        [
            [
                "a" => "green",
                "b" => "brown",
                "c" => "blue",
                "red"
            ],
            [
                "a" => "GREEN",
                "B" => "brown",
                "yellow", "red"
            ],
            'strcasecmp',
        ],
    ];

    // public $synopsis = 'array array_udiff_assoc ( array $array1 , array $array2 [, array $... ], callable $value_compare_func )';
    public $synopsis = 'array array_udiff_assoc ( array $array1 , array $array2 , callable $value_compare_func )';

    function pre_exec_function()
    {
        $this->returned_params['value_compare_func'] = $this->_filter->filter_callback('value_compare_func');
    }
}
