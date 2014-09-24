<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class class_parents extends function_core
{
    public $examples = ["application", "class_parents", "Exception", "xyz"];

    public $options_getter = ['class' => 'get_declared_classes'];

    public $synopsis = 'array class_parents ( mixed $class [, bool $autoload = true ] )';
}
