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

class in_array extends function_core
{
    public $examples = [
        [
            "Irix",
            ["Mac", "NT", "Irix", "Linux"],
        ],
        [
            "mac",
            ["Mac", "NT", "Irix", "Linux"],
        ],
        [
            '12.4',
            ['1.10', 12.4, 1.13],
            true
        ],
        [
            1.13,
            ['1.10', 12.4, 1.13],
            true
        ],
        [
            ['p', 'h'],
            [
                ['p', 'h'],
                ['p', 'r'],
                'o'
            ],
        ],
        [
            ['f', 'i'],
            [
                ['p', 'h'],
                ['p', 'r'],
                'o'
            ],
        ],
        [
            'o',
            [
                ['p', 'h'],
                ['p', 'r'],
                'o'
            ],
        ],
    ];

    public $synopsis = 'bool in_array ( mixed $needle , array $haystack [, bool $strict = FALSE ] )';
}
