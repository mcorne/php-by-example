<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class substr_count extends function_core
{
    public $examples = [
        [
            "This is a test",
            "is"
        ],
        [
            "This is a test",
            "is",
            3
        ],
        [
            "This is a test",
            "is",
            3,
            3
        ],
        [
            "This is a test",
            "is",
            5,
            10
        ],
        [
            "gcdgcdgcd",
            "gcdgcd"
        ]
    ];

    public $synopsis = 'int substr_count ( string $haystack , string $needle [, int $offset = 0 [, int $length ]] )';
}
