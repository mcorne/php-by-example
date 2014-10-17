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

class gmp_hamdist extends function_core
{
    public $examples = [
        ["0b1001010011", "0b1011111100"],
    ];

    public $synopsis = 'int gmp_hamdist ( resource $a , resource $b )';
}
