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
 * @see docs/function-configuration.txt
 */

class gmp_legendre extends function_core
{
    public $examples = [
        ["1", "3"],
        ["2", "3"]
    ];

    public $synopsis = 'int gmp_legendre ( resource $a , resource $p )';
}
