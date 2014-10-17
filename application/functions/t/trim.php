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

class trim extends function_core
{
    public $examples = [
        '_DOUBLE_QUOTES_\t\tThese are a few words :) ...  _DOUBLE_QUOTES_',
        [
            '_DOUBLE_QUOTES_\t\tThese are a few words :) ...  _DOUBLE_QUOTES_',
            '_DOUBLE_QUOTES_ \t._DOUBLE_QUOTES_'
        ],
        [
            "Hello World",
            "Hdle"
        ],
        [
            "Hello World",
            "HdWr"
        ],
        [
            '_DOUBLE_QUOTES_\x09Example string\x0A_DOUBLE_QUOTES_',
            '_DOUBLE_QUOTES_\x00..\x1F_DOUBLE_QUOTES_'
        ],
        'apple',
        'banana ',
        ' cranberry '
    ];

    public $synopsis = 'string trim ( string $str [, string $charlist = &quot; \t\n\r\0\x0B&quot; ] )';
}
