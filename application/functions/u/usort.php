<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'uasort.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class usort extends uasort
{
    public $examples = [
        [
            '__array' => [
                0 => 3,
                1 => 2,
                2 => 5,
                3 => 6,
                4 => 1,
            ],
            '$array',
            'compare_func',
        ],
    ];

    public $synopsis = 'bool usort ( array &$array , callable $value_compare_func )';
}
