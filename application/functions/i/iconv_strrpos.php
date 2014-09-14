<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */
require_once 'iconv_strpos.php';

class iconv_strrpos extends iconv_strpos
{
    public $examples = [
        [
            "hello world",
            'o',
            "UTF-8",
        ],
        [
            "hello world",
            'x',
            "UTF-8",
        ],
    ];

    public $synopsis = 'int iconv_strrpos ( string $haystack , string $needle [, string $charset = ini_get(&quot;iconv.internal_encoding&quot;) ] )';
}
