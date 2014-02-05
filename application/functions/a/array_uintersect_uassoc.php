<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'array_diff_uassoc.php';

class array_uintersect_uassoc extends array_diff_uassoc
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
    ];

    public $synopsis = 'array array_uintersect_uassoc ( array $array1 , array $array2 [, array $... ], callable $value_compare_func , callable $key_compare_func )';
}
