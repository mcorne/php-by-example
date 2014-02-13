<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class preg_replace extends function_core
{
    public $examples = [
        ['/(\w+) (\d+), (\d+)/i', '${1}1,$3', "April 15, 2003"],
        [
            ['/quick/', '/brown/', '/fox/'],
            ['bear', 'black', 'slow'],
            "The quick brown fox jumped over the lazy dog."
        ],
        [
            ['/quick/', '/brown/', '/fox/'],
            ['slow', 'black', 'bear'],
            "The quick brown fox jumped over the lazy dog."
        ],
        [
            [
                0 => '/(19|20)(\d{2})-(\d{1,2})-(\d{1,2})/',
                1 => '/^\s*{(\w+)}\s*=/',
            ],
            [
                0 => '\3/\4/\1\2',
                1 => '$\1 =',
            ],
            '{startDate} = 1999-5-27'
        ],
        ['/\s\s+/', " ", "foo   o"],
        [
            [
                0 => '/\d/',
                1 => '/\s/',
            ],
            "*",
            "xp 4 to",
            -1,
            '$count'
        ]
    ];

    public $synopsis = 'mixed preg_replace ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )';
}
