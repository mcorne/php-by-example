<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class idn_to_ascii extends function_core
{
    public $examples = ["täst.de"];

    public $synopsis = 'string idn_to_ascii ( string $domain [, int $options = 0 [, int $variant = INTL_IDNA_VARIANT_2003 [, array &$idna_info ]]] )';
}