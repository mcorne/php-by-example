<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_search extends function_core
{
    public $examples = [
        [
            'green',
            [
                0 => 'blue',
                1 => 'red',
                2 => 'green',
                3 => 'red'
            ],
        ],
        [
            'red',
            [
                0 => 'blue',
                1 => 'red',
                2 => 'green',
                3 => 'red'
            ],
        ],
    ];

    public $synopsis = 'mixed array_search ( mixed $needle , array $haystack [, bool $strict = false ] )';
}
