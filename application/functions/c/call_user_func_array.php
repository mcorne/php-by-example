<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'call_user_func.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class call_user_func_array extends call_user_func
{
    public $examples = [
        [
            'foobar',
            [
                0 => "one",
                1 => "two",
            ],
        ],
        [
            '$barber',
            ["mushroom"],
        ],
        [
            ['myclass', 'say_hello'],
            [],
        ],
        [
            'myclass::say_hello',
            [],
        ],
        [
            ['$object', 'say_goodbye'],
            ['Bob']
        ],
        [
            'strncmp',
            [
                "abc",
                "DEF",
                3,
            ]
        ],
        [
            'foobar',
        ],
        [
            'foobar',
            123
        ],
    ];

    public $synopsis       = 'mixed call_user_func_array ( callable $callback , array $param_arr )';
    public $synopsis_fixed = null;
}
