<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mcrypt_module_get_algo_block_size.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mcrypt_module_get_supported_key_sizes extends mcrypt_module_get_algo_block_size
{
    public $synopsis = 'array mcrypt_module_get_supported_key_sizes ( string $algorithm [, string $lib_dir ] )';
}
