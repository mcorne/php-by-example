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

class unserialize extends function_core
{
    public $examples = ['a:2:{s:1:"a";i:123;i:456;a:1:{i:0;s:3:"bcd";}}'];

    public $synopsis = 'mixed unserialize ( string $str )';
}
