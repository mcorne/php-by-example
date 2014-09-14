<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

require_once 'idn_to_ascii.php';

class idn_to_utf8 extends idn_to_ascii
{
    public $examples = ["xn--tst-qla.de"];

    public $synopsis = 'string idn_to_utf8 ( string $domain [, int $options = 0 [, int $variant = INTL_IDNA_VARIANT_2003 [, array &$idna_info ]]] )';
}
