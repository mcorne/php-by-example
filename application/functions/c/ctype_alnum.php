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

class ctype_alnum extends function_core
{
    public $examples = ['AbCd1zyZ9', 'foo!#$bar'];

    public $synopsis = 'bool ctype_alnum ( string $text )';
}
