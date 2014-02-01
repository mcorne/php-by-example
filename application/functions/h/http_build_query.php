<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class http_build_query extends function_core
{
    public $examples = [
        [
            [
                'foo' => 'bar',
                'baz' => 'boom',
                'cow' => 'milk',
                'php' => 'hypertext processor',
            ]
        ],
        [
            [
                'foo' => 'bar',
                'baz' => 'boom',
                'cow' => 'milk',
                'php' => 'hypertext processor',
            ],
            "",
            "&amp;"
        ],
        [
            [
                0 => 'foo',
                1 => 'bar',
                2 => 'baz',
                3 => 'boom',
                'cow' => 'milk',
                'php' => 'hypertext processor',
            ]
        ],
        [
            [
                0 => 'foo',
                1 => 'bar',
                2 => 'baz',
                3 => 'boom',
                'cow' => 'milk',
                'php' => 'hypertext processor',
            ],
            "myvar_"
        ],
        [
            [
                'user' =>
                [
                  'name' => 'Bob Smith',
                  'age' => 47,
                  'sex' => 'M',
                  'dob' => '5/12/1956',
                ],
                'pastimes' =>
                [
                  0 => 'golf',
                  1 => 'opera',
                  2 => 'poker',
                  3 => 'rap',
                ],
                'children' =>
                [
                  'bobby' =>
                  [
                    'age' => 12,
                    'sex' => 'M',
                  ],
                  'sally' =>
                  [
                    'age' => 8,
                    'sex' => 'F',
                  ],
                ],
                0 => 'CEO',
            ],
            "flags_"
        ]
    ];

    public $synopsis = 'string http_build_query ( mixed $query_data [, string $numeric_prefix [, string $arg_separator [, int $enc_type = PHP_QUERY_RFC1738 ]]] )';
}
