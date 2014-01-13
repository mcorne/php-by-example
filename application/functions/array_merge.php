<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_merge extends function_core
{
    public $examples = [
        [
            [
                'foo',
            ],
            [
                1 => 'bar'
            ],
        ],
        [
            [
                "color" => "red",
                2,
                4,
            ],
            [
                "a",
                "b",
                "color" => "green",
                "shape" => "trapezoid",
                4,
            ],
        ],
        [
            [
            ],
            [
                1 => "data"
            ],
        ],
    ];

    public $synopsis = 'array array_merge ( array $array1 [, array $array2] )';
}
