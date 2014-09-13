<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_check_encoding.php';

class mb_detect_encoding extends mb_check_encoding
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

    public $synopsis = 'string mb_detect_encoding ( string $str [, mixed $encoding_list = mb_detect_order() [, bool $strict = false ]] )';
}
