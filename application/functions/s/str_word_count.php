<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class str_word_count extends function_core
{
    public $examples = [
        [ "Hello fri3nd, you're
       looking          good today!", 1],
        ["Hello fri3nd, you're
       looking          good today!", 2],
        ["Hello fri3nd, you're
       looking          good today!", 1, 'àáãç3'],
    ];

    public $options_range = ['format' => [0, 2]];

    public $synopsis = 'mixed str_word_count ( string $string [, int $format = 0 [, string $charlist ]] )';
}
