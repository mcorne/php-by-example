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

class interface_exists extends function_core
{
    public $examples = ["MyInterface", "ArrayAccess"];

    public $options_getter = ['interface_name' => 'get_declared_interfaces'];

    public $synopsis = 'bool interface_exists ( string $interface_name [, bool $autoload = true ] )';
}
