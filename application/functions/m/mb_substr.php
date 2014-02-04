<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class mb_substr extends function_core
{
    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $examples = [
        ["español", 3, 3, 'UTF-8'],
    ];

    public $synopsis = 'string mb_substr ( string $str , int $start [, int $length = NULL [, string $encoding = mb_internal_encoding() ]] )';
}
