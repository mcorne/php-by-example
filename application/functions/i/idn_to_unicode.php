<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'idn_to_utf8.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class idn_to_unicode extends idn_to_utf8
{
    public $synopsis = 'string idn_to_unicode ( string $domain [, int $options = 0 [, int $variant = INTL_IDNA_VARIANT_2003 [, array &$idna_info ]]] )';
}
