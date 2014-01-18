<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_sum extends function_core
{
    public $examples = [
        [
            [2, 4, 6, 8],
        ],
        [
            ["a" => 1.2, "b" => 2.3, "c" => 3.4],
        ],
        [
            [],
        ],
    ];

    public $synopsis = 'number array_sum ( array $array )';
}
