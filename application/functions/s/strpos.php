<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class strpos extends function_core
{
    public $examples = [
        [
            "abc",
            "a"
        ],
        [
            "abc",
            "a"
        ],
        [
            "abcdef abcdef",
            "a",
            1
        ]
    ];

    public $synopsis = 'mixed strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )';
}
