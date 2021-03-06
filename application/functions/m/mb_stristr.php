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

class mb_stristr extends mb_convert_case
{
    public $examples = [
        ["española", 'ol', false],
        ["española", 'ol', true, 'UTF-8'],
        ["española", 'OL', false, 'UTF-8'],
        ["española", 'an', false, 'UTF-8'],
    ];

    public $synopsis = 'string mb_stristr ( string $haystack , string $needle [, bool $before_needle = false [, string $encoding = mb_internal_encoding() ]] )';
}
