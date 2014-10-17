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
