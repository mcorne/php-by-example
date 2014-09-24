<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class class_exists extends function_core
{
    public $examples = ["Exception", "action", "xyz"];

    public $options_getter = ['class_name' => 'get_declared_classes'];

    public $synopsis = 'bool class_exists ( string $class_name [, bool $autoload = true ] )';
}
