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
