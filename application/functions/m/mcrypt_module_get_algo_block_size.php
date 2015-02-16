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

class mcrypt_module_get_algo_block_size extends function_core
{
    public $constant_prefix = ['algorithm' => 'MCRYPT'];

    public $examples = ["MCRYPT_RIJNDAEL_128"];

    public $synopsis = 'int mcrypt_module_get_algo_block_size ( string $algorithm [, string $lib_dir ] )';
}
