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

class array_keys extends function_core
{
    public $examples = [
        [
            [
                0       => 100,
                "color" => "red"
            ],
        ],
        [
            [
                "blue",
                "red",
                "green",
                "blue",
                "blue"
            ],
            "blue"
        ],
        [
            [
                "color" => array("blue", "red", "green"),
                "size"  => array("small", "medium", "large")
            ],
        ],
    ];

    public $synopsis = 'array array_keys ( array $array [, mixed $search_value [, bool $strict = false ]] )';
}
