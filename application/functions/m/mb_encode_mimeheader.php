<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class mb_encode_mimeheader extends function_core
{
    public $examples = [
        ["éléphant", "UTF-7", "Q"]
    ];

    public $synopsis = 'string mb_encode_mimeheader ( string $str [, string $charset = mb_internal_encoding() [, string $transfer_encoding = &quot;B&quot; [, string $linefeed = &quot;\r\n&quot; [, int $indent = 0 ]]]] )';
}
