<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class array_diff_uassoc extends function_core
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
                "a" => "green",
                "yellow",
                "red"
            ],
            'compare_func',
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
            'strcmp',
        ],
    ];

    public $helper_callbacks = ['index_in_example' => 2, 'function_name_pattern' => '~(cmp$)~'];

    public $source_code = '
        // custom callback function
        function compare_func($a, $b) {
            if ($a === $b) return 0;
            if ($a > $b)   return 1;
            return -1;
        };

        inject_function_call
    ';

    public $synopsis = 'array array_diff_uassoc ( array $array1 , array $array2 [, array $... ], callable $key_compare_func )';

    function pre_exec_function()
    {
        $this->_filter->filter_callback('key_compare_func');
    }
}
