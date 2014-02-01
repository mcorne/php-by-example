<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class iconv extends function_core
{
    public $examples = [
        [
            "UTF-8",
            "ISO-8859-1//TRANSLIT",
            "This is the Euro symbol '€'.",
        ],
        [
            "UTF-8",
            "ISO-8859-1//IGNORE",
            "This is the Euro symbol '€'.",
        ],
        [
            "UTF-8",
            "ISO-8859-1",
            "This is the Euro symbol '€'.",
        ],
    ];

    public $synopsis = 'string iconv ( string $in_charset , string $out_charset , string $str )';
}
