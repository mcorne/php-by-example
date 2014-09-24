<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

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

    public $options_getter = ['charset'  => 'mb_list_encodings'];

    public $source_code = '
        inject_function_call

        // enter non ASCII chars in hex in $_haystack or $_needle if $_charset is not UTF-8
    ';

    public $synopsis = 'int iconv_strpos ( string $haystack , string $needle [, int $offset = 0 [, string $charset = ini_get(&quot;iconv.internal_encoding&quot;) ]] )';
}
