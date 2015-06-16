<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'grapheme_extract.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class grapheme_substr extends grapheme_extract
{
    public $examples = [
        [
            '_DOUBLE_QUOTES_aoa\xCC\x8Abco\xCC\x88O_DOUBLE_QUOTES_',
            2,
            -1,
        ],
    ];

    public $synopsis       = 'int grapheme_substr ( string $string , int $start [, int $length ] )'; // typo in PHP manual
    public $synopsis_fixed = 'string grapheme_substr ( string $string , int $start [, int $length ] )';
}
