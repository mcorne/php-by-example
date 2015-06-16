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
 * @see docs/function-configuration.txt
 */

class grapheme_strlen extends function_core
{
    public $examples = ['_DOUBLE_QUOTES_abca\xCC\x8Ao\xCC\x88a\xCC\x8A_DOUBLE_QUOTES_'];

    public $synopsis = 'int grapheme_strlen ( string $input )';
}
