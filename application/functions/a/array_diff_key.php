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

class array_diff_key extends function_core
{
    public $examples = [
        [
            [
                'blue'   => 1,
                'red'    => 2,
                'green'  => 3,
                'purple' => 4
            ],
            [
                'green'  => 5,
                'blue'   => 6,
                'yellow' => 7,
                'cyan'   => 8
            ],
        ],
    ];

    public $synopsis = 'array array_diff_key ( array $array1 , array $array2 [, array $... ] )';
}
