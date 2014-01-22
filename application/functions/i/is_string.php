<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class is_string extends function_core
{
    public $examples = [false, true, null, 'abc', '23', 23, '23.5', 23.5, '', ' ', '0', 0];

    public $synopsis = 'bool is_string ( mixed $var )';
}
