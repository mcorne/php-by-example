<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class preg_grep extends function_core
{public $examples = [
        [
            '/^(\d+)?\.\d+$/',
            [
                0 => 123,
                1 => 0.456,
                2 => 'xyz',
            ],
        ]
    ];
    public $synopsis = 'array preg_grep ( string $pattern , array $input [, int $flags = 0 ] )';
}
