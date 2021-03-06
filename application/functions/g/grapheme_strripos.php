<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class grapheme_strripos extends function_core
{
    public $examples = [
        [
            '_DOUBLE_QUOTES_a\xCC\x8Ao\xCC\x88o\xCC\x88_DOUBLE_QUOTES_',
            '_DOUBLE_QUOTES_o\xCC\x88_DOUBLE_QUOTES_',
        ],
    ];
    
    public $synopsis = 'int grapheme_strripos ( string $haystack , string $needle [, int $offset = 0 ] )';
}
