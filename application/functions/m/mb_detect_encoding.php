<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class mb_detect_encoding extends function_core
{
    public $options_getter = ['encoding_list' => 'mb_list_encodings'];

    public $examples = [
        "éléphant",
        "house",
        [
            "house",
            'UTF-8, ASCII',
        ],
        [
            "house",
            ['ASCII', 'UTF-8'],
        ],
    ];

    public $source_code = '
inject_function_call

// enter non UTF-8 characters in hex in $_str
';

    public $synopsis = 'string mb_detect_encoding ( string $str [, mixed $encoding_list = mb_detect_order() [, bool $strict = false ]] )';
}
