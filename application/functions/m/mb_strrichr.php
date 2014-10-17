<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_stristr.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mb_strrichr extends mb_stristr
{
    public $synopsis = 'string mb_strrichr ( string $haystack , string $needle [, bool $part = false [, string $encoding = mb_internal_encoding() ]] )';
}
