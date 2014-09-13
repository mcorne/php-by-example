<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class mb_stripos extends function_core
{
    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $examples = [
        ["español", 'ol', 0, 'UTF-8'],
        ["español", 'OL', 0, 'UTF-8'],
        ["español", 'an', 0, 'UTF-8'],
        ["español", 'pa', 4, 'UTF-8']
    ];

    public $synopsis = 'int mb_stripos ( string $haystack , string $needle [, int $offset = 0 [, string $encoding = mb_internal_encoding() ]] )';
}
