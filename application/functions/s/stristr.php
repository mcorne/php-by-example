<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class stristr extends function_core
{
    public $examples = [
        [
            "USER@EXAMPLE.com",
            "e"
        ],
        [
            "USER@EXAMPLE.com",
            "e",
            true
        ],
        [
            "Hello World!",
            "earth"
        ],
        [
            "APPLE",
            97
        ]
    ];

    public $synopsis = 'string stristr ( string $haystack , mixed $needle [, bool $before_needle = false ] )';
}
