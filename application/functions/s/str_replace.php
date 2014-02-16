<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class str_replace extends function_core
{
    public $examples = [
        [
            "%body%",
            "black",
            "<body text='%body%'>"
        ],
        [
            [
                0 => "a",
                1 => "e",
                2 => "i",
                3 => "o",
                4 => "u",
                5 => "A",
                6 => "E",
                7 => "I",
                8 => "O",
                9 => "U",
            ],
            "",
            "Hello World of PHP"
        ],
        [
            [
                0 => "fruits",
                1 => "vegetables",
                2 => "fiber",
            ],
            [
                0 => "pizza",
                1 => "beer",
                2 => "ice cream",
            ],
            "You should eat fruits, vegetables, and fiber every day."
        ],
        [
            "ll",
            "",
            "good golly miss molly!"
        ],
        [
            [
                0 => "\r\n",
                1 => "\n",
                2 => "\r",
            ],
            [
                0 => "B",
                1 => "C",
                2 => "D",
                3 => "E",
                4 => "F",
            ],
            "Line 1\nLine 2\rLine 3\r\nLine 4\n"
        ],
        [
            [
                0 => "A",
                1 => "B",
                2 => "C",
                3 => "D",
                4 => "E",
            ],
            [
                0 => "B",
                1 => "C",
                2 => "D",
                3 => "E",
                4 => "F",
            ],
            "A"
        ],
        [
            [
                0 => "a",
                1 => "p",
            ],
            [
                0 => "apple",
                1 => "pear",
            ],
            "a p"
        ]
    ];

    public $synopsis = 'mixed str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )';
}
