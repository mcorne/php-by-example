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

class openssl_digest extends function_core
{
    public $examples = [
        [
            'this is some data',
            'md5',
        ]
    ];

    public $options_getter = ['method' => 'openssl_get_md_methods'];

    public $synopsis = 'string openssl_digest ( string $data , string $method [, bool $raw_output = false ] )';
}
