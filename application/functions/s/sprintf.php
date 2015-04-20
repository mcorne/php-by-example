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

class sprintf extends function_core
{
    public $examples = [
        [
            "There are %d monkeys in the %s",
            5,
            "tree"
        ],
        [
            "The %s contains %d monkeys",
            5,
            "tree"
        ],
        [
            'The %2$s contains %1$d monkeys',
            5,
            "tree"
        ],
        [
            'The %2$s contains %1$d monkeys.
            That\'s a nice %2$s full of %1$d monkeys.',
            5,
            "tree"
        ],
        [
            'The %2$s contains %1$04d monkeys',
            5,
            "tree"
        ],
        [
            "%b",
            43951789
        ],
        [
            "%c",
            65
        ],
        [
            "%d",
            43951789
        ],
        [
            "%e",
            43951789
        ],
        [
            "%u",
            43951789
        ],
        [
            "%u",
            -43951789
        ],
        [
            "%f",
            43951789
        ],
        [
            "%o",
            43951789
        ],
        [
            "%s",
            43951789
        ],
        [
            "%x",
            43951789
        ],
        [
            "%X",
            43951789
        ],
        [
            "%+d",
            43951789
        ],
        [
            "%+d",
            -43951789
        ],
        [
            "[%s]",
            'monkey'
        ],
        [
            "[%10s]",
            'monkey'
        ],
        [
            "[%-10s]",
            'monkey'
        ],
        [
            "[%010s]",
            'monkey'
        ],
        [
            "[%'#10s]",
            'monkey'
        ],
        [
            "[%10.10s]",
            'many monkeys'
        ],
        [
            "%04d-%02d-%02d",
            '2014',
            '2',
            '15'
        ],
        [
            "%01.2f",
            123.1,
        ],
        [
            "%.3e",
            362525200
        ]
    ];

    public $synopsis       = 'string sprintf ( string $format [, mixed $args [, mixed $... ]] )';
    public $synopsis_fixed = 'string sprintf ( string $format , mixed $arg0 , mixed $arg1 , mixed $arg2 [, mixed $... ] )';

    public $test_not_validated = 10; // result either positive or negative depending on the platform
}
