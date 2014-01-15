<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_chunk extends function_core
{
    public $examples = [
        [
            [ 'a', 'b', 'c', 'd', 'e' ],
            2,
        ],
        [
            [ 'a', 'b', 'c', 'd', 'e' ],
            2,
            'true',
        ]
    ];

    public $synopsis = 'array array_chunk ( array $array , int $size [, bool $preserve_keys = false ] )';
}
