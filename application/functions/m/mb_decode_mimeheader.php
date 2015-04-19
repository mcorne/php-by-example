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

class mb_decode_mimeheader extends function_core
{
    public $examples = ["=?UTF-8?Q?=C3=A9l=C3=A9phant?="];

    public $synopsis = 'string mb_decode_mimeheader ( string $str )';

    public $test_not_validated = true;
}
