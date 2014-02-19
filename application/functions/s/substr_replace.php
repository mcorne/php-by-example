<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class substr_replace extends function_core
{
    public $examples = [
        [
            "ABCDEFGH:/MNRPQR/",
            "bob",
            0
        ],
        [
            "ABCDEFGH:/MNRPQR/",
            "bob",
            0,
            17
        ],
        [
            "ABCDEFGH:/MNRPQR/",
            "bob",
            0,
            0
        ],
        [
            "ABCDEFGH:/MNRPQR/",
            "bob",
            10,
            -1
        ],
        [
            "ABCDEFGH:/MNRPQR/",
            "bob",
            -7,
            -1
        ],
        [
            "ABCDEFGH:/MNRPQR/",
            "",
            10,
            -1
        ],
        [
            [
                0 => "A: XXX",
                1 => "B: XXX",
                2 => "C: XXX",
            ],
            "YYY",
            3,
            3
        ],
        [
            [
                0 => "A: XXX",
                1 => "B: XXX",
                2 => "C: XXX",
            ],
            [
                0 => "AAA",
                1 => "BBB",
                2 => "CCC",
            ],
            3,
            3
        ],
        [
            [
                0 => "A: XXX",
                1 => "B: XXX",
                2 => "C: XXX",
            ],
            [
                0 => "AAA",
                1 => "BBB",
                2 => "CCC",
            ],
            3,
            [
                0 => 1,
                1 => 2,
                2 => 3,
            ]
        ]
    ];

    public $synopsis = 'mixed substr_replace ( mixed $string , mixed $replacement , mixed $start [, mixed $length ] )';
}
