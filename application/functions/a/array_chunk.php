<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
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
            true,
        ]
    ];

    public $synopsis = 'array array_chunk ( array $array , int $size [, bool $preserve_keys = false ] )';
}
