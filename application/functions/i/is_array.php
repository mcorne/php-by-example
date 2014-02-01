<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class is_array extends function_core
{
    public $examples = [
        [
            [
                0 => 'this',
                1 => 'is',
                2 => 'an array',
            ]
        ],
        "this is a string"
    ];

    public $synopsis = 'bool is_array ( mixed $var )';
}
