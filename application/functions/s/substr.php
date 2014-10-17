<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class substr extends function_core
{
    public $examples = [
        [
            "abcdef",
            -1
        ],
        [
            "abcdef",
            -2
        ],
        [
            "abcdef",
            -3,
            1
        ],
        [
            "abcdef",
            0,
            -1
        ],
        [
            "abcdef",
            2,
            -1
        ],
        [
            "abcdef",
            4,
            -4
        ],
        [
            "abcdef",
            -3,
            -1
        ],
        [
            "abcdef",
            1
        ],
        [
            "abcdef",
            1,
            3
        ],
        [
            "abcdef",
            0,
            4
        ],
        [
            "abcdef",
            0,
            8
        ],
        [
            "abcdef",
            -1,
            1
        ],
        ["pear", 0, 2],
        [54321, 0, 2],
        [true, 0, 1],
        [false, 0, 1],
        ["", 0, 1],
        [1.2e3, 0, 4],
        [
            "a",
            1
        ]
    ];

    public $synopsis = 'string substr ( string $string , int $start [, int $length ] )';
}
