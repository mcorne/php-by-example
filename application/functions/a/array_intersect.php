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

class array_intersect extends function_core
{
    public $examples = [
        [
            [
                "a" => "green",
                "red",
                "blue"
            ],
            [
                "b" => "green",
                "yellow",
                "red"
            ],
        ],
    ];

    public $synopsis = 'array array_intersect ( array $array1 , array $array2 [, array $... ] )';
}
