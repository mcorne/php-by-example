<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'openssl_pkey_get_private.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class openssl_pkey_get_public extends openssl_pkey_get_private
{
    public $examples = [
        [
            // openssl rsa -in private-key.pem -pubout -out public-key.pem
            'file:///tmp/public-key.pem',
        ],
        [
            // openssl rsa -in private-key-with-pass.pem -passin pass:"this is a passphrase" -pubout -out public-key-with-pass.pem
            'file:///tmp/public-key-with-pass.pem',
        ],
        [
            '-----BEGIN PUBLIC KEY-----
            MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0llCeBjy18RylTdBih9G
            MUSZIC3GzeN0vQ9W8E3nwy2jdeUnH3GBXWpMo3F43V68zM2Qz5epRNmlLSkY/PJU
            fJIC8Yc1VEokT52q87hH/XJ5eS8heZnjuSlPAGi8oZ3ImVbruzV7XmlD+QsCSxJW
            7tBv0dqJ71e1gAAisCXK2m7iyf/ul6rT0Zz0ptYH4IZfwc/hQ9JcMg69uM+3bb4o
            BFsixMmEQwxKZsXk3YmO/YRjRbay+6+79bSV/frW+lWhknyGSIJp2CJArYcOdbK1
            bXx1dRWpbNSExo7dWwuPC0Y7a5AEeoZofieQPPBhXlp1hPgLYGat71pDqBjKLvF5
            GwIDAQAB
            -----END PUBLIC KEY-----',
        ],
    ];

    public $synopsis = 'resource openssl_pkey_get_public ( mixed $certificate )';

    function pre_exec_function()
    {
        $this->copy_key_to_temp('public-key.pem');
        $this->copy_key_to_temp('public-key-with-pass.pem');
    }
}
