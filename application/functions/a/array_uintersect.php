<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'array_udiff.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class array_uintersect extends array_udiff
{
    public $examples = [
        [
            [
                "a" => "green",
                "b" => "brown",
                "c" => "blue",
                "red"
            ],
            [
                "a" => "GREEN",
                "B" => "brown",
                "yellow",
                "red"
            ],
            'strcasecmp',
        ],
    ];

    public $synopsis = 'array array_uintersect ( array $array1 , array $array2 [, array $... ], callable $value_compare_func )';
}
