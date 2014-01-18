<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_diff extends function_core
{
    public $examples = [
        [
            [
                "a" => "green",
                "red",
                "blue",
                "red"
            ],
            [
                "b" => "green",
                "yellow",
                "red"
            ],
        ],
    ];

    public $synopsis = 'array array_diff ( array $array1 , array $array2 [, array $... ] )';
}
