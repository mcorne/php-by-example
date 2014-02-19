<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class stripos extends function_core
{
    public $examples = [
        [
            "xyz",
            "a"
        ],
        [
            "ABC",
            "a"
        ]
    ];

    public $synopsis = 'int stripos ( string $haystack , string $needle [, int $offset = 0 ] )';
}
