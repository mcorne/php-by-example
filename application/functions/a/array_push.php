<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'array_pop.php';

class array_push extends array_pop
{
    public $examples = [
        [
            '__array' => ["orange", "banana"],
            '$array',
            "apple",
            "raspberry"
        ],
    ];

    // public $synopsis = 'int array_push ( array &$array , mixed $value1 [, mixed $... ] )';
    public $synopsis = 'int array_push ( array &$array , mixed $value1 [, mixed $value2 [, mixed $... ]] )';
}
