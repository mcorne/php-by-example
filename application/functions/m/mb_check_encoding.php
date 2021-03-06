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

class mb_check_encoding extends function_core
{
    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $examples = [
        ['Hello world', 'ASCII'],
        ['está', 'ASCII'],
        ['\xe0 is a grave', "ISO-8859-1"], // "à" in ISO
    ];

    public $source_code = '
        inject_function_call

        // enter non ASCII characters in hex if $_encoding is not UTF-8
    ';

    public $synopsis = 'bool mb_check_encoding ([ string $var = NULL [, string $encoding = mb_internal_encoding() ]] )';
}
