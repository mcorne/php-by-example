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

class class_exists extends function_core
{
    public $examples = ["Exception", "action", "xyz"];

    public $options_getter = ['class_name' => 'get_declared_classes'];

    public $synopsis = 'bool class_exists ( string $class_name [, bool $autoload = true ] )';
}
