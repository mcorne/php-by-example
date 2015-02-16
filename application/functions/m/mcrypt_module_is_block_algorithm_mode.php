<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class mcrypt_module_is_block_algorithm_mode extends function_core
{
    public $constant_prefix = ['mode'   => 'MCRYPT_MODE'];

    public $examples = ["MCRYPT_MODE_CBC"];

    public $synopsis = 'bool mcrypt_module_is_block_algorithm_mode ( string $mode [, string $lib_dir ] )';
}
