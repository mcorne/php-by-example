<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class str_pad extends function_core
{
    public $constant_prefix = ['pad_type' => 'STR_PAD'];

    public $examples = [
        [
            "Alien",
            10
        ],
        [
            "Alien",
            10,
            "-=",
            'STR_PAD_LEFT'
        ],
        [
            "Alien",
            10,
            "_",
            'STR_PAD_BOTH'
        ],
        [
            "Alien",
            6,
            '___'
        ]
    ];

    public $synopsis = 'string str_pad ( string $input , int $pad_length [, string $pad_string = &quot; &quot; [, int $pad_type = STR_PAD_RIGHT ]] )';
}
