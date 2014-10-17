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

class array_merge_recursive extends function_core
{
    public $examples = [
        [
            [
                "color" => [
                    "favorite" => "red"
                ],
                5,
            ],
            [
                10,
                "color" => [
                    "favorite" => "green",
                    "blue"
                ]
            ],
        ],
    ];

    public $synopsis       = 'array array_merge_recursive ( array $array1 [, array $... ] )';
    public $synopsis_fixed = 'array array_merge_recursive ( array $array1 , array $array2 [, array $... ] )';
}
