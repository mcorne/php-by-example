<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class preg_filter extends function_core
{
    public $examples = [
        [
            [
                0 => '/\d/',
                1 => '/[a-z]/',
                2 => '/[1a]/',
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
