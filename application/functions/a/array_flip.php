<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_flip extends function_core
{
    public $examples = [
        [
            [
                "a" => 1,
                "b" => 2,
                "c" => 3
            ],
        ],
        [
            [
                "a" => 1,
                "b" => 1,
                "c" => 2
            ],
        ],
    ];

    public $synopsis = 'array array_flip ( array $array )';
}
