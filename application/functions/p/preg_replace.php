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

class preg_replace extends function_core
{
    public $examples = [
        ['_SINGLE_QUOTE_/(\w+) (\d+), (\d+)/i_SINGLE_QUOTE_', '${1}1,$3', "April 15, 2003"],
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
                0 => '_SINGLE_QUOTE_/(19|20)(\d{2})-(\d{1,2})-(\d{1,2})/_SINGLE_QUOTE_',
                1 => '_SINGLE_QUOTE_/^\s*{(\w+)}\s*=/_SINGLE_QUOTE_',
            ],
            [
                0 => '_SINGLE_QUOTE_\3/\4/\1\2_SINGLE_QUOTE_',
                1 => '_SINGLE_QUOTE_$\1 =_SINGLE_QUOTE_',
            ],
            '{startDate} = 1999-5-27'
        ],
        ['_SINGLE_QUOTE_/\s\s+/_SINGLE_QUOTE_', " ", "foo   o"],
        [
            [
                0 => '_SINGLE_QUOTE_/\d/_SINGLE_QUOTE_',
                1 => '_SINGLE_QUOTE_/\s/_SINGLE_QUOTE_',
            ],
            "*",
            "xp 4 to",
            -1,
            '$count'
        ]
    ];

    public $synopsis = 'mixed preg_replace ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )';
}
