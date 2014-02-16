<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class strcspn extends function_core
{
    public $examples = [
        [
            "abcd",
            "apple"
        ],
        [
            "abcd",
            "banana"
        ],
        [
            "hello",
            "l"
        ],
        [
            "hello",
            "world"
        ]
    ];

    public $synopsis = 'int strcspn ( string $str1 , string $str2 [, int $start [, int $length ]] )';
}
