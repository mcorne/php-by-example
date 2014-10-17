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

class ctype_graph extends function_core
{
    public $examples = ['_DOUBLE_QUOTES_asdf\n\r\t_DOUBLE_QUOTES_', 'arf12', 'LKA#@%.54'];

    public $synopsis = 'bool ctype_graph ( string $text )';
}
