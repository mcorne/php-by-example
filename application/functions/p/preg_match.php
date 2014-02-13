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
    public $examples = [
        ['/^def/', "abcdef", '$matches', 'PREG_OFFSET_CAPTURE', 3],
        ['/^def/', "def", '$matches', 'PREG_OFFSET_CAPTURE'],
        ['/php/i', "PHP is the web scripting language of choice.", '$matches'],
        ['/\bweb\b/i', "PHP is the web scripting language of choice.", '$matches'],
        ['/\bweb\b/i', "PHP is the website scripting language of choice.", '$matches'],
        ['@^(?:http://)?([^/]+)@i', "http://www.php.net/index.html", '$matches'],
        ['/[^.]+\.[^.]+$/', "http://www.php.net", '$matches'],
        ['/(?P<name>\w+): (?P<digit>\d+)/', "foobar: 2008", '$matches']
    ];

    public $synopsis = 'int preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] )';
}
