<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class iconv_substr extends function_core
{
    public $examples = [
        [
            "Prüfung Prüfung",
            2,
            5,
            "UTF-8",
        ],
    ];

    public $synopsis       = 'string iconv_substr ( string $str , int $offset [, int $length = iconv_strlen($str, $charset) [, string $charset = ini_get(&quot;iconv.internal_encoding&quot;) ]] )';
    public $synopsis_fixed = 'string iconv_substr ( string $str , int $offset [, int $length = iconv_strlen($str, $_charset) [, string $charset = ini_get("iconv.internal_encoding") ]] )';
}
