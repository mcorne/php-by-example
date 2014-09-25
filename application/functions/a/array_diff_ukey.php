<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'array_diff_uassoc.php';

class array_diff_ukey extends array_diff_uassoc
{
    public $examples = [
        [
            [
                'blue'   => 1,
                'red'    => 2,
                'green'  => 3,
                'purple' => 4
            ],
            [
                'green'  => 5,
                'blue'   => 6,
                'yellow' => 7,
                'cyan'   => 8
            ],
            'compare_func',
        ],
        [
            [
                0 => "a",
                1 => "c",
            ],
            [
                0 => "a",
                2 => "b",
            ],
            'gmp_cmp',
        ],
    ];

    public $synopsis = 'array array_diff_ukey ( array $array1 , array $array2 [, array $... ], callable $key_compare_func )';
}
