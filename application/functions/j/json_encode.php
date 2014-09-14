<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class json_encode extends function_core
{
    public $constant_prefix = ['options' => 'JSON'];

    public $examples = [
        [
            [
                'a' => 1,
                'b' => 2,
                'c' => 3,
                'd' => 4,
                'e' => 5,
            ]
        ],
        [
            [
                '<foo>',
                "'bar'",
                '_SINGLE_QUOTE_"baz"_SINGLE_QUOTE_',
                '&blong&',
                '_DOUBLE_QUOTES_\xc3\xa9_DOUBLE_QUOTES_'
            ],
        ],
        [
            [
                '<foo>',
                "'bar'",
                '_SINGLE_QUOTE_"baz"_SINGLE_QUOTE_',
                '&blong&',
                '_DOUBLE_QUOTES_\xc3\xa9_DOUBLE_QUOTES_'
            ],
            'JSON_HEX_TAG'
        ],
        [
            [
                '<foo>',
                "'bar'",
                '_SINGLE_QUOTE_"baz"_SINGLE_QUOTE_',
                '&blong&',
                '_DOUBLE_QUOTES_\xc3\xa9_DOUBLE_QUOTES_'
            ],
            'JSON_HEX_APOS'
        ],
        [
            [
                '<foo>',
                "'bar'",
                '_SINGLE_QUOTE_"baz"_SINGLE_QUOTE_',
                '&blong&',
                '_DOUBLE_QUOTES_\xc3\xa9_DOUBLE_QUOTES_'
            ],
            'JSON_HEX_QUOT'
        ],
        [
            [
                '<foo>',
                "'bar'",
                '_SINGLE_QUOTE_"baz"_SINGLE_QUOTE_',
                '&blong&',
                '_DOUBLE_QUOTES_\xc3\xa9_DOUBLE_QUOTES_'
            ],
            'JSON_HEX_AMP'
        ],
        [
            [
                '<foo>',
                "'bar'",
                '_SINGLE_QUOTE_"baz"_SINGLE_QUOTE_',
                '&blong&',
                '_DOUBLE_QUOTES_\xc3\xa9_DOUBLE_QUOTES_'
            ],
            'JSON_UNESCAPED_UNICODE'
        ],
        [
            [
                '<foo>',
                "'bar'",
                '_SINGLE_QUOTE_"baz"_SINGLE_QUOTE_',
                '&blong&',
                '_DOUBLE_QUOTES_\xc3\xa9_DOUBLE_QUOTES_'
            ],
            'JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE'
        ],
        [
            [],
        ],
        [
            [],
            'JSON_FORCE_OBJECT'
        ],
        [
            [[1,2,3]],
        ],
        [
            [[1,2,3]],
            'JSON_FORCE_OBJECT'
        ],
        [
            ['foo' => 'bar', 'baz' => 'long'],
        ],
        [
            ['foo' => 'bar', 'baz' => 'long'],
            'JSON_FORCE_OBJECT'
        ],
        [
            ["foo", "bar", "baz", "blong"],
        ],
        [
            [1=>"foo", 2=>"bar", 3=>"baz", 4=>"blong"],
        ]
    ];

    public $synopsis = 'string json_encode ( mixed $value [, int $options = 0 [, int $depth = 512 ]] )';
}
