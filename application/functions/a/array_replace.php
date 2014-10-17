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

class array_replace extends function_core
{
    public $examples = [
        [
            [
                "orange",
                "banana",
                "apple",
                "raspberry"
            ],
            [
                0 => "pineapple",
                4 => "cherry"
            ],
            [
                0 => "grape"
            ],
        ],
    ];

    public $synopsis       = 'array array_replace ( array $array1 , array $array2 [, array $... ] )';
    public $synopsis_fixed = 'array array_replace ( array $array1 , array $array2 [, array $array3 [, array $... ] )';
}
