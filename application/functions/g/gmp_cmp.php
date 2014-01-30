<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class gmp_cmp extends function_core
{
    public $examples = [
        ["1234", "1000"],
        ["1000", "1234"],
        ["1234", "1234"]
    ];

    public $synopsis = 'int gmp_cmp ( resource $a , resource $b )';
}
