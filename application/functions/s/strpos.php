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
