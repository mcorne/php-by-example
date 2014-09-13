<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

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

// enter non UTF-8 characters in hex
';

    public $synopsis = 'bool mb_check_encoding ([ string $var = NULL [, string $encoding = mb_internal_encoding() ]] )';
}
