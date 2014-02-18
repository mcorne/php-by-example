<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class preg_match_all extends function_core
{
    const STR = <<<FOO
a: 1
b: 2
c: 3
FOO;

    public $examples = [
        [
            "|<[^>]+>(.*)</[^>]+>|U",
            '<b>example: </b><div align="left">this is a test</div>',
            '$out',
            'PREG_PATTERN_ORDER',
        ],
        [
            "|<[^>]+>(.*)</[^>]+>|U",
            '<b>example: </b><div align="left">this is a test</div>',
            '$out',
            'PREG_SET_ORDER',
        ],
        [
            '_SINGLE_QUOTE_/\(?  (\d{3})?  \)?  (?(1)  [\-\s] ) \d{3}-\d{4}/x_SINGLE_QUOTE_',
            "Call 555-1212 or 1-800-555-1212",
            '$phones',
        ],
        [
            '_SINGLE_QUOTE_/(<([\w]+)[^>]*>)(.*?)(<\/\2>)/_SINGLE_QUOTE_',
            "<b>bold text</b><a href=howdy.html>click me</a>",
            '$matches',
            'PREG_SET_ORDER',
        ],
        [
            '_SINGLE_QUOTE_/(?P<name>\w+): (?P<digit>\d+)/_SINGLE_QUOTE_',
            self::STR,
            '$matches',
        ],
    ];

    public $synopsis = 'int preg_match_all ( string $pattern , string $subject [, array &$matches [, int $flags = PREG_PATTERN_ORDER [, int $offset = 0 ]]] )';
}
