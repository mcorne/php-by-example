<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class wordwrap extends function_core
{
    public $examples = [
        [
            "The quick brown fox jumped over the lazy dog.",
            20,
            '_DOUBLE_QUOTES_<br />\n_DOUBLE_QUOTES_'
        ],
        [
            "A very long woooooooooooord.",
            8,
            '_DOUBLE_QUOTES_\n_DOUBLE_QUOTES_',
            true
        ]
    ];

    public $synopsis = 'string wordwrap ( string $str [, int $width = 75 [, string $break = &quot;\n&quot; [, bool $cut = false ]]] )';
}
