<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_div_qr.php';

class gmp_gcdext extends gmp_div_qr
{
    public $examples = [
        [12, 21],
    ];

    public $synopsis = 'array gmp_gcdext ( resource $a , resource $b )';
}
