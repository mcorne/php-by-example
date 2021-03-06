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

class mb_encode_mimeheader extends function_core
{
    public $options_getter = ['charset' => 'mb_list_encodings'];

    public $examples = [
        ["éléphant", "UTF-8", "Q"]
    ];

    public $options_list = ['transfer_encoding' => ['B', 'Q']];

    public $source_code = '
        inject_function_call

        // enter non ASCII characters in hex if $_charset is not UTF-8
    ';

    public $synopsis = 'string mb_encode_mimeheader ( string $str [, string $charset = mb_internal_encoding() [, string $transfer_encoding = &quot;B&quot; [, string $linefeed = &quot;\r\n&quot; [, int $indent = 0 ]]]] )';
}
