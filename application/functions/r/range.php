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

class range extends function_core
{
    public $examples = [
        [
            0,
            12
        ],
        [
            0,
            100,
            10
        ],
        [
            "a",
            "i"
        ],
        [
            "c",
            "a"
        ]
    ];

    public $synopsis       = 'array range ( mixed $start , mixed $end [, number $step = 1 ] )';
    public $synopsis_fixed = 'array range ( mixed $start , mixed $end [, int $step = 1 ] )';
}
