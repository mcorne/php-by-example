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

class array_slice extends function_core
{
    public $examples = [
        [
            ["a", "b", "c", "d", "e"],
            2
        ],
        [
            ["a", "b", "c", "d", "e"],
            -2,
            1
        ],
        [
            ["a", "b", "c", "d", "e"],
            0,
            3
        ],
        [
            ["a", "b", "c", "d", "e"],
            2,
            -1,
        ],
        [
            ["a", "b", "c", "d", "e"],
            2,
            -1,
            true
        ],
    ];

    public $synopsis = 'array array_slice ( array $array , int $offset [, int $length = NULL [, bool $preserve_keys = false ]] )';
}
