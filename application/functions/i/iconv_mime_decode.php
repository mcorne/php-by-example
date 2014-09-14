<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class iconv_mime_decode extends function_core
{
    public $constant_prefix = ['mode' => 'ICONV_MIME'];

    public $examples = [
        ["Subject: =?UTF-8?B?UHLDvGZ1bmcgUHLDvGZ1bmc=?=", 0, "UTF-8"],
        ["Subject: =?UTF-8?B?UHLDvGZ1bmcgUHLDvGZ1bmc=?=", 0, "ISO-8859-1"]
    ];

    public $options_getter = ['charset'  => 'mb_list_encodings'];

    public $source_code = '
inject_function_call

// the result may not display properly if $_charset is not UTF-8
';

    public $synopsis = 'string iconv_mime_decode ( string $encoded_header [, int $mode = 0 [, string $charset = ini_get(&quot;iconv.internal_encoding&quot;) ]] )';
}
