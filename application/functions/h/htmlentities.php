<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class htmlentities extends function_core
{
    public $examples = [
        "A 'quote' is <b>bold</b>",
        ["A 'quote' is <b>bold</b>", 'ENT_QUOTES'],
        ["\x8F!!!", 'ENT_QUOTES', "UTF-8"],
        ["\x8F!!!", 'ENT_QUOTES | ENT_IGNORE', "UTF-8"]
    ];

    public $synopsis = 'string htmlentities ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = &#039;UTF-8&#039; [, bool $double_encode = true ]]] )';
}
