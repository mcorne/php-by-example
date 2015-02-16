<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_convert_case.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class mb_stripos extends mb_convert_case
{
    public $examples = [
        ["español", 'ol', 0],
        ["español", 'OL', 0, 'UTF-8'],
        ["español", 'an', 0, 'UTF-8'],
        ["español", 'pa', 4, 'UTF-8']
    ];

    public $synopsis = 'int mb_stripos ( string $haystack , string $needle [, int $offset = 0 [, string $encoding = mb_internal_encoding() ]] )';
}
