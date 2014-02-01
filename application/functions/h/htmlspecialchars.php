<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class htmlspecialchars extends function_core
{
    public $examples = [
        ["<a href='test'>Test</a>", 'ENT_QUOTES']
    ];

    public $synopsis = 'string htmlspecialchars ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = &#039;UTF-8&#039; [, bool $double_encode = true ]]] )';
}
