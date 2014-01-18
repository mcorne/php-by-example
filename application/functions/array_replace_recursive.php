<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_replace_recursive extends function_core
{
    public $examples = [
        [
            [
                'citrus' => ["orange"],
                'berries' => ["blackberry", "raspberry"],
            ],
            [
                'citrus' => ['pineapple'],
                'berries' => ['blueberry'],
            ],
        ],
        [
            [
                'citrus' => ["orange"],
                'berries' => ["blackberry", "raspberry"],
                'others' => 'banana'
            ],
            [
                'citrus' => 'pineapple',
                'berries' => ['blueberry'],
                'others' => ['litchis']
            ],
            [
                'citrus' => ['pineapple'],
                'berries' => ['blueberry'],
                'others' => 'litchis'
            ],
        ],
    ];

    // public $synopsis = 'array array_replace_recursive ( array $array1 , array $array2 [, array $... ] )';
    public $synopsis = 'array array_replace_recursive ( array $array1 , array $array2 [, array $array3 [, array $... ]] )';
}
