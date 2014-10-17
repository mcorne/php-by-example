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

class preg_filter extends function_core
{
    public $examples = [
        [
            [
                0 => '_SINGLE_QUOTE_/\d/_SINGLE_QUOTE_',
                1 => '_SINGLE_QUOTE_/[a-z]/_SINGLE_QUOTE_',
                2 => '_SINGLE_QUOTE_/[1a]/_SINGLE_QUOTE_',
            ],
            [
                0 => 'A:$0',
                1 => 'B:$0',
                2 => 'C:$0',
            ],
            [
                0 => '1',
                1 => 'a',
                2 => '2',
                3 => 'b',
                4 => '3',
                5 => 'A',
                6 => 'B',
                7 => '4',
            ]
        ]
    ];

    public $synopsis = 'mixed preg_filter ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )';
}
