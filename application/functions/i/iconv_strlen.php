<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class iconv_strlen extends function_core
{
    public $examples = [
        ["hello world", "UTF-8"],
    ];

    public $options_getter = ['charset'  => 'mb_list_encodings'];

    public $synopsis = 'int iconv_strlen ( string $str [, string $charset = ini_get(&quot;iconv.internal_encoding&quot;) ] )';
}
