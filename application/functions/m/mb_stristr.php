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

class mb_stristr extends mb_convert_case
{
    public $examples = [
        ["española", 'ol', false],
        ["española", 'ol', true, 'UTF-8'],
        ["española", 'OL', false, 'UTF-8'],
        ["española", 'an', false, 'UTF-8'],
    ];

    public $source_code = '
mb_internal_encoding("UTF-8");

inject_function_call

// enter non ASCII chars in hex in $_haystack or $_needle if $_encoding is not UTF-8
// the result $_string may not display properly if $_encoding is not UTF-8
';

    public $synopsis = 'string mb_stristr ( string $haystack , string $needle [, bool $before_needle = false [, string $encoding = mb_internal_encoding() ]] )';
}
