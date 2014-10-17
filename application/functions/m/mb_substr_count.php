<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_stripos.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mb_substr_count extends mb_stripos
{
    public $examples = [
        ["This is a test", "is"]
    ];

    public $synopsis = 'int mb_substr_count ( string $haystack , string $needle [, string $encoding = mb_internal_encoding() ] )';
}
