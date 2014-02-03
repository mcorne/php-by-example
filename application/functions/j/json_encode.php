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
                '<foo>',"'bar'",
                '"baz"','&blong&',
                "\xc3\xa9"
            ],
        ],
        [
            [
                '<foo>',"'bar'",
                '"baz"','&blong&',
                "\xc3\xa9"
            ],
            'JSON_HEX_TAG'
        ],
        [
            [
                '<foo>',"'bar'",
                '"baz"','&blong&',
                "\xc3\xa9"
            ],
            'JSON_HEX_APOS'
        ],
        [
            [
                '<foo>',"'bar'",
                '"baz"','&blong&',
                "\xc3\xa9"
            ],
            'JSON_HEX_QUOT'
        ],
        [
            [
                '<foo>',"'bar'",
                '"baz"','&blong&',
                "\xc3\xa9"
            ],
            'JSON_HEX_AMP'
        ],
        [
            [
                '<foo>',"'bar'",
                '"baz"','&blong&',
                "\xc3\xa9"
            ],
            'JSON_UNESCAPED_UNICODE'
        ],
        [
            [
                '<foo>',"'bar'",
                '"baz"','&blong&',
                "\xc3\xa9"
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
