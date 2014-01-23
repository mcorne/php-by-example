<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class count extends function_core
{
    public $examples = [
        [
            [1, 3, 5],
        ],
        [
            [
                0  => 7,
                5  => 9,
                10 => 11,
            ],
        ],
        [
            null
        ],
        [
            false
        ],
        [
            [
                'fruits' => ['orange', 'banana', 'apple'],
                'veggie' => ['carrot', 'collard', 'pea']
            ],
            COUNT_RECURSIVE
        ],
        [
            [
                'fruits' => ['orange', 'banana', 'apple'],
                'veggie' => ['carrot', 'collard', 'pea']
            ],
        ],
    ];

    public $synopsis = 'int count ( mixed $array_or_countable [, int $mode = COUNT_NORMAL ] )';
}
