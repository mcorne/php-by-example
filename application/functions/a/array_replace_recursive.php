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
 * @see docs/function-configuration.txt
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

    public $synopsis       = 'array array_replace_recursive ( array $array1 , array $array2 [, array $... ] )';
    public $synopsis_fixed = 'array array_replace_recursive ( array $array1 , array $array2 [, array $array3 [, array $... ]] )';
}
