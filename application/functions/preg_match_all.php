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
            '/\(?  (\d{3})?  \)?  (?(1)  [\-\s] ) \d{3}-\d{4}/x',
            "Call 555-1212 or 1-800-555-1212",
            '$phones',
        ],
        [
            '/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/',
            "<b>bold text</b><a href=howdy.html>click me</a>",
            '$matches',
            'PREG_SET_ORDER',
        ],
        [
            '/(?P<name>\w+): (?P<digit>\d+)/',
            self::STR,
            '$matches',
        ],
    ];

    public $synopsis = 'int preg_match_all ( string $pattern , string $subject [, array &$matches [, int $flags = PREG_PATTERN_ORDER [, int $offset = 0 ]]] )';
}
