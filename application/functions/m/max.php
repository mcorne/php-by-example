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

class max extends function_core
{
    public $examples = [
        [5, 6, 7],
        [
            [2, 4, 5]
        ],
        [0, 'hello'],
        ['hello', 0],
        ['42', 3],
        [-1, 'hello'],
        [
            [2, 2, 2],
            [1, 1, 1, 1]
        ],
        [
            [2, 4, 8],
            [2, 5, 7]
        ],
        [
            'string',
            [2, 5, 7],
            42
        ],
    ];

    public $synopsis       = 'mixed max ( mixed $value1 , mixed $value2 [, mixed $... ] )';
    public $synopsis_fixed = 'mixed max ( mixed $value1 , mixed $value2 , mixed $value3 [, mixed $... ] )';
}
