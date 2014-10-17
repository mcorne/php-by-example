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

class stristr extends function_core
{
    public $examples = [
        [
            "USER@EXAMPLE.com",
            "e"
        ],
        [
            "USER@EXAMPLE.com",
            "e",
            true
        ],
        [
            "Hello World!",
            "earth"
        ],
        [
            "APPLE",
            97
        ]
    ];

    public $synopsis = 'string stristr ( string $haystack , mixed $needle [, bool $before_needle = false ] )';
}
