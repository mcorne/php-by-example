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

class openssl_get_cert_locations extends function_core
{
    public $synopsis = 'array openssl_get_cert_locations ( void )';

    public $test_not_validated = true;
}
