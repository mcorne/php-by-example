<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'array_pop.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class array_unshift extends array_pop
{
    public $examples = [
        [
            '__array' => ["orange", "banana"],
            '$array',
            "apple",
            "raspberry"
        ],
    ];

    public $synopsis = 'int array_unshift ( array &$array , mixed $value1 , mixed $value2 [, mixed $... ] )';
}
