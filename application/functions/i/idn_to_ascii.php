<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class idn_to_ascii extends function_core
{
    public $constant_prefix = ['variant' => 'INTL_IDNA'];

    public $examples = ["täst.de"];

    public $synopsis = 'string idn_to_ascii ( string $domain [, int $options = 0 [, int $variant = INTL_IDNA_VARIANT_2003 [, array &$idna_info ]]] )';
}
