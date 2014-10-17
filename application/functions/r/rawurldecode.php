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

class rawurldecode extends function_core
{
    public $examples = ["foo%20bar%40baz"];

    public $synopsis = 'string rawurldecode ( string $str )';
}
