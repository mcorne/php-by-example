<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'array_walk.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class array_walk_recursive extends array_walk
{
    public $examples = [
        [
            '__array' => [
                'sweet' => [
                    'a' => 'apple',
                    'b' => 'banana'
                ],
                'sour' => 'lemon'
            ],
            '$array',
            'test_print'
        ],
        [
            '__array' => [
                "d" => "lemon",
                "a" => "orange",
                "b" => "banana",
                "c" => "apple"
            ],
            '$array',
            'test_alter',
            'fruit'
        ],
    ];

    public $synopsis = 'bool array_walk_recursive ( array &$array , callable $callback [, mixed $userdata = NULL ] )';
}
