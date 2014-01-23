<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_unique extends function_core
{
    public $examples = [
        [
            [
                "a" => "green",
                "red",
                "b" => "green",
                "blue", "red",
            ],
        ],
        [
            [4, "4", "3", 4, 3, "3"],
        ],
    ];

    public $synopsis = 'array array_unique ( array $array [, int $sort_flags = SORT_STRING ] )';
}
