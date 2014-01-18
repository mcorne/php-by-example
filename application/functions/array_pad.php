<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
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
