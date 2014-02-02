<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class is_numeric extends function_core
{
    public $examples = ["42", 1337, 0x539, 02471, 0b10100111001, 1337e0, "not numeric", [[]], 9.1];

    public $synopsis = 'bool is_numeric ( mixed $var )';
}
