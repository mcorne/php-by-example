<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_intersect_assoc extends function_core
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
        ],
        [
            [0, 1, 2],
            ["00", "01", "2"],
        ],
    ];

    public $synopsis = 'array array_intersect_assoc ( array $array1 , array $array2 [, array $... ] )';
}
