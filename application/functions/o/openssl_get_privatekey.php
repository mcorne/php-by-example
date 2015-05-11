<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'openssl_pkey_get_private.php';

class openssl_get_privatekey extends openssl_pkey_get_private
{
    public $synopsis = 'resource openssl_get_privatekey ( mixed $key [, string $passphrase = &quot;&quot; ] )';
}
