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

class intval extends function_core
{
    public $examples = [
        42,
        4.2,
        "42",
        "+42",
        "-42",
        '_NO_QUOTE_042',
        "042",
        '_NO_QUOTE_1e10',
        "1e10",
        '_NO_QUOTE_0x1A',
        42000000,
        '_NO_QUOTE_420000000000000000000',
        "420000000000000000000",
        [42, 8],
        ["42", 8],
        [
            [
            ]
        ],
        [
            [
                0 => 'foo',
                1 => 'bar',
            ]
        ]
    ];

    public $synopsis = 'int intval ( mixed $var [, int $base = 10 ] )';
}
