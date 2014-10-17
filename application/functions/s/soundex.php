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

class soundex extends function_core
{
    public $examples = ["Euler", "Ellery", "Gauss", "Ghosh", "Hilbert", "Heilbronn", "Knuth", "Kant", "Lloyd", "Ladd", "Lukasiewicz", "Lissajous"];

    public $synopsis = 'string soundex ( string $str )';
}
