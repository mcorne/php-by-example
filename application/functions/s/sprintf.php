<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
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
            "%%b = '%b'",
            43951789
        ],
        [
            "%%c = '%c'",
            65
        ],
        [
            "%%d = '%d'",
            43951789
        ],
        [
            "%%e = '%e'",
            43951789
        ],
        [
            "%%u = '%u'",
            43951789
        ],
        [
            "%%u = '%u'",
            -43951789
        ],
        [
            "%%f = '%f'",
            43951789
        ],
        [
            "%%o = '%o'",
            43951789
        ],
        [
            "%%s = '%s'",
            43951789
        ],
        [
            "%%x = '%x'",
            43951789
        ],
        [
            "%%X = '%X'",
            43951789
        ],
        [
            "%%+d = '%+d'",
            43951789
        ],
        [
            "%%+d = '%+d'",
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
}
