<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class interface_exists extends function_core
{
    public $examples = ["MyInterface", "ArrayAccess"];

    public $options_getter = ['interface_name' => 'get_declared_interfaces'];

    public $synopsis = 'bool interface_exists ( string $interface_name [, bool $autoload = true ] )';
}
