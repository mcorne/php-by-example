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

class array_pad extends function_core
{
    public $examples = [
        [
            [12, 10, 9],
            5,
            0,
        ],
        [
            [12, 10, 9],
            -7,
            -1
        ],
        [
            [12, 10, 9],
            2,
            "noop"
        ],
    ];

    public $synopsis = 'array array_pad ( array $array , int $size , mixed $value )';
}
