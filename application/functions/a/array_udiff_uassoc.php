<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'array_diff_uassoc.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class array_udiff_uassoc extends array_diff_uassoc
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
            'strcasecmp',
        ],
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
            'compare_func',
            'compare_func',
        ],
    ];

    public $synopsis = 'array array_udiff_uassoc ( array $array1 , array $array2 [, array $... ], callable $value_compare_func , callable $key_compare_func )';

    function pre_exec()
    {
        $this->_filter->filter_callback('key_compare_func');
        $this->_filter->filter_callback('value_compare_func');
    }
}
