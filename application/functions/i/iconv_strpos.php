<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class iconv_strpos extends function_core
{
    public $examples = [
        [
            "hello world",
            'world',
            0,
            "UTF-8",
        ],
    ];

    public $synopsis = 'int iconv_strpos ( string $haystack , string $needle [, int $offset = 0 [, string $charset = ini_get(&quot;iconv.internal_encoding&quot;) ]] )';
}
