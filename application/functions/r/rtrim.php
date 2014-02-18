<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class rtrim extends function_core
{
    public $examples = [
        '_DOUBLE_QUOTES_\t\tThese are a few words :) ...  _DOUBLE_QUOTES_',
        ['_DOUBLE_QUOTES_\t\tThese are a few words :) ...  _DOUBLE_QUOTES_', '_DOUBLE_QUOTES_ \t._DOUBLE_QUOTES_'],
        ["Hello World", "Hdle"],
        ['_DOUBLE_QUOTES_\x09Example string\x0A_DOUBLE_QUOTES_', '_DOUBLE_QUOTES_\x00..\x1F_DOUBLE_QUOTES_']
    ];

    public $synopsis = 'string rtrim ( string $str [, string $charlist ] )';
}
