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

class get_extension_funcs extends function_core
{
    public $examples = ["xml"];

    public $options_getter = ['module_name' => 'get_loaded_extensions'];

    public $synopsis = 'array get_extension_funcs ( string $module_name )';

    public $test_not_validated = true;
}
