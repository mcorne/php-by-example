<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
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
