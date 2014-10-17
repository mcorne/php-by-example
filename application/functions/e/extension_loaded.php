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

class extension_loaded extends function_core
{
    public $examples = ["gd"];

    public $options_getter = ['name' => 'get_loaded_extensions'];

    public $synopsis = 'bool extension_loaded ( string $name )';
}
