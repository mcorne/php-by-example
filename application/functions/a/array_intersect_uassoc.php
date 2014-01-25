<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'array_diff_uassoc.php';

class array_intersect_uassoc extends array_diff_uassoc
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
                "yellow",
                "red"
            ],
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

    // public $synopsis = 'array array_intersect_uassoc ( array $array1 , array $array2 [, array $... ], callable $key_compare_func )';
    public $synopsis = 'array array_intersect_uassoc ( array $array1 , array $array2 , callable $key_compare_func )';
}
