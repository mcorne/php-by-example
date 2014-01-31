<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class gmp_hamdist extends function_core
{
    public $examples = [
        ["0b1001010011", "0b1011111100"],
    ];

    public $synopsis = 'int gmp_hamdist ( resource $a , resource $b )';
}
