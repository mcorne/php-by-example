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

class strpbrk extends function_core
{
    public $examples = [
        [
            "This is a Simple text.",
            "mi"
        ],
        [
            "This is a Simple text.",
            "S"
        ]
    ];

    public $synopsis = 'string strpbrk ( string $haystack , string $char_list )';
}
