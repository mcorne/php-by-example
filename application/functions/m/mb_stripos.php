<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

require_once 'mb_convert_case.php';

class mb_stripos extends mb_convert_case
{
    public $examples = [
        ["español", 'ol', 0],
        ["español", 'OL', 0, 'UTF-8'],
        ["español", 'an', 0, 'UTF-8'],
        ["español", 'pa', 4, 'UTF-8']
    ];

    public $source_code = '
mb_internal_encoding("UTF-8");

inject_function_call

// enter non ASCII chars in hex in $_haystack or $_needle if $_encoding is not UTF-8
';

    public $synopsis = 'int mb_stripos ( string $haystack , string $needle [, int $offset = 0 [, string $encoding = mb_internal_encoding() ]] )';
}
