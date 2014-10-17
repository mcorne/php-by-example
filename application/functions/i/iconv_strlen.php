<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class iconv_strlen extends function_core
{
    public $examples = [
        ["hello world", "UTF-8"],
    ];

    public $options_getter = ['charset'  => 'mb_list_encodings'];

    public $source_code = '
        inject_function_call

        // enter non ASCII characters in hex in $_str if $_charset is not UTF-8
    ';

    public $synopsis = 'int iconv_strlen ( string $str [, string $charset = ini_get(&quot;iconv.internal_encoding&quot;) ] )';
}
