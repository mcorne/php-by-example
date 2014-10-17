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

class strrpos extends function_core
{
    public $examples = [
        [
            "0123456789a123456789b123456789c",
            "7",
            -5
        ],
        [
            "0123456789a123456789b123456789c",
            "7",
            20
        ],
        [
            "0123456789a123456789b123456789c",
            "7",
            28
        ]
    ];

    public $synopsis = 'int strrpos ( string $haystack , string $needle [, int $offset = 0 ] )';
}
