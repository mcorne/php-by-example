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

class ctype_xdigit extends function_core
{
    public $examples = ['AB10BC99', 'AR1012', 'ab12bc99'];

    public $synopsis = 'bool ctype_xdigit ( string $text )';
}
