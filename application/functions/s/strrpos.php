<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class strrpos extends function_core
{
    public $examples = [
        [
            "0123456789a123456789b123456789c",
            "7",
            -5
        ],
        [
            "0123456789a123456789b123456789c",
            "7",
            20
        ],
        [
            "0123456789a123456789b123456789c",
            "7",
            28
        ]
    ];

    public $synopsis = 'int strrpos ( string $haystack , string $needle [, int $offset = 0 ] )';
}
