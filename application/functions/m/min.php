<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class min extends function_core
{
    public $examples = [
        [1, 6, 7],
        [
            [2, 4, 5]
        ],
        [0, 'hello'],
        ['hello', 0],
        ['hello', -1],
        [
            [2, 4, 8],
            [2, 5, 7]
        ],
        [
            'string',
            [2, 5, 7],
            42
        ],
        [-100,-10, NULL],
        [-100,-10, FALSE],
    ];

    public $synopsis       = 'mixed min ( mixed $value1 , mixed $value2 [, mixed $... ] )';
    public $synopsis_fixed = 'mixed min ( mixed $value1 , mixed $value2 , mixed $value3 [, mixed $... ] )';
}
