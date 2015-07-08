<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class unpack extends function_core
{
    public $examples = [
        [
            "cchars/nint",
            '_DOUBLE_QUOTES_\x04\x00\xa0\x00_DOUBLE_QUOTES_',
        ],
        [
            "c2chars/nint",
            '_DOUBLE_QUOTES_\x04\x00\xa0\x00_DOUBLE_QUOTES_',
        ],
        [
            "c2/n",
            '_DOUBLE_QUOTES_\x32\x42\x00\xa0_DOUBLE_QUOTES_',
        ]
    ];

    public $synopsis = 'array unpack ( string $format , string $data )';
}
