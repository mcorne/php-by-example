<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class mb_stristr extends function_core
{
    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $examples = [
        ["española", 'ol', false, 'UTF-8'],
        ["española", 'ol', true, 'UTF-8'],
        ["española", 'OL', false, 'UTF-8'],
        ["española", 'an', false, 'UTF-8'],
    ];

    public $synopsis = 'string mb_stristr ( string $haystack , string $needle [, bool $before_needle = false [, string $encoding = mb_internal_encoding() ]] )';
}
