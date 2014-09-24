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

    public $options_getter = ['charset'  => 'mb_list_encodings'];

    public $source_code = '
        inject_function_call

        // enter non ASCII characters in hex in $_str if $_charset is not UTF-8
        // the result $_string may not display properly if $_charset is not UTF-8
    ';

    public $synopsis       = 'string iconv_substr ( string $str , int $offset [, int $length = iconv_strlen($str, $charset) [, string $charset = ini_get(&quot;iconv.internal_encoding&quot;) ]] )';
    public $synopsis_fixed = 'string iconv_substr ( string $str , int $offset [, int $length = iconv_strlen($str, $_charset) [, string $charset = ini_get("iconv.internal_encoding") ]] )';
}
