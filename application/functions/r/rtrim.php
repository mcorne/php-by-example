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
        "\t\tThese are a few words :) ...  ",
        ["\t\tThese are a few words :) ...  ", " \t."],
        ["Hello World", "Hdle"],
        ["\x09Example string\x0A", "\x00..\x1F"]
    ];

    public $synopsis = 'string rtrim ( string $str [, string $charlist ] )';
}
