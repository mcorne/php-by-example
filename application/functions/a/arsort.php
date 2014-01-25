<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'array_pop.php';

class arsort extends array_pop
{
    public $examples = [
        [
            '__array' => [
                "d" => "lemon",
                "a" => "orange",
                "b" => "banana",
                "c" => "apple"
            ],
            '$array',
        ],
    ];

    public $synopsis = 'bool arsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )';
}
