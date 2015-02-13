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
 * @see docs/function-configuration.txt
 */

class mcrypt_module_self_test extends function_core
{
    public $constant_prefix = ['algorithm' => 'MCRYPT'];

    public $examples = ["MCRYPT_RIJNDAEL_128"];

    public $synopsis = 'bool mcrypt_module_self_test ( string $algorithm [, string $lib_dir ] )';
}
