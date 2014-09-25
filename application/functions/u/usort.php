<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'uasort.php';

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
