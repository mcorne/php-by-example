<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class substr_compare extends function_core
{
    public $examples = [
        [
            "abcde",
            "bc",
            1,
            2
        ],
        [
            "abcde",
            "de",
            -2,
            2
        ],
        [
            "abcde",
            "bcg",
            1,
            2
        ],
        [
            "abcde",
            "BC",
            1,
            2,
            true
        ],
        [
            "abcde",
            "bc",
            1,
            3
        ],
        [
            "abcde",
            "cd",
            1,
            2
        ],
        [
            "abcde",
            "abc",
            5,
            1
        ]
    ];

    public $synopsis = 'int substr_compare ( string $main_str , string $str , int $offset [, int $length [, bool $case_insensitivity = false ]] )';
}
