<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class preg_match extends function_core
{
    public $constant_prefix = ['flags' => 'PREG'];

    public $examples = [
        ['/^def/', "abcdef", '$matches', 'PREG_OFFSET_CAPTURE', 3],
        ['/^def/', "def", '$matches', 'PREG_OFFSET_CAPTURE'],
        ['/php/i', "PHP is the web scripting language of choice.", '$matches'],
        ['_SINGLE_QUOTE_/\bweb\b/i_SINGLE_QUOTE_', "PHP is the web scripting language of choice.", '$matches'],
        ['_SINGLE_QUOTE_/\bweb\b/i_SINGLE_QUOTE_', "PHP is the website scripting language of choice.", '$matches'],
        ['@^(?:http://)?([^/]+)@i', "http://www.php.net/index.html", '$matches'],
        ['_SINGLE_QUOTE_/[^.]+\.[^.]+$/_SINGLE_QUOTE_', "http://www.php.net", '$matches'],
        ['_SINGLE_QUOTE_/(?P<name>\w+): (?P<digit>\d+)/_SINGLE_QUOTE_', "foobar: 2008", '$matches']
    ];

    public $synopsis = 'int preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] )';
}
