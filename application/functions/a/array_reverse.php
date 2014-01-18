<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_reverse extends function_core
{
    public $examples = [
        [
            [
                "php",
                4.0,
                ["green", "red"]
            ],
        ],
        [
            [
                "php",
                4.0,
                ["green", "red"]
            ],
            true
        ],
    ];

    public $synopsis = 'array array_reverse ( array $array [, bool $preserve_keys = false ] )';
}
