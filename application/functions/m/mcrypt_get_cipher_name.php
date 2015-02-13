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

class mcrypt_get_cipher_name extends function_core
{
    public $constant_prefix = ['cipher' => 'MCRYPT'];

    public $examples = ["MCRYPT_TripleDES"];

    public $synopsis = 'string mcrypt_get_cipher_name ( int $cipher )';
}
