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

class array_shift extends array_pop
{
    public $examples = [
        [
            '__array' => ["orange", "banana", "apple", "raspberry"],
            '$array',
        ],
    ];

    public $synopsis = 'mixed array_shift ( array &$array )';
}
