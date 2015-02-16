<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mcrypt_module_is_block_algorithm_mode.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mcrypt_module_is_block_mode extends mcrypt_module_is_block_algorithm_mode
{
    public $synopsis = 'bool mcrypt_module_is_block_mode ( string $mode [, string $lib_dir ] )';
}
