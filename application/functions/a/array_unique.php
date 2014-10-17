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

class array_unique extends function_core
{
    public $examples = [
        [
            [
                "a" => "green",
                "red",
                "b" => "green",
                "blue", "red",
            ],
        ],
        [
            [4, "4", "3", 4, 3, "3"],
        ],
    ];

    public $synopsis = 'array array_unique ( array $array [, int $sort_flags = SORT_STRING ] )';
}
