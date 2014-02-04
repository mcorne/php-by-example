<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class mb_strwidth extends function_core
{
    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $examples = [
        ["ñ", 'UTF-8'],
        ["n", 'UTF-8'],
        ["現", 'UTF-8'],
    ];

    public $synopsis = 'int mb_strwidth ( string $str [, string $encoding = mb_internal_encoding() ] )';
}
