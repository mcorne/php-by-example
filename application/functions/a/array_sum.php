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

class array_sum extends function_core
{
    public $examples = [
        [
            [2, 4, 6, 8],
        ],
        [
            ["a" => 1.2, "b" => 2.3, "c" => 3.4],
        ],
        [
            [],
        ],
    ];

    public $synopsis = 'number array_sum ( array $array )';
}
