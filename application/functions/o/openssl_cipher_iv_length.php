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

class openssl_cipher_iv_length extends function_core
{
    public $examples = ["AES-128-CBC"];

    public $options_getter = ['method' => 'openssl_get_cipher_methods'];

    public $synopsis = 'int openssl_cipher_iv_length ( string $method )';
}
