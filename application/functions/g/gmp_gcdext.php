<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_div_qr.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class gmp_gcdext extends gmp_div_qr
{
    public $examples = [
        [12, 21],
    ];

    public $synopsis = 'array gmp_gcdext ( resource $a , resource $b )';
}
