<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'openssl_pkey_new.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class openssl_pkey_get_public extends openssl_pkey_new
{
    public $examples = [
        ['file:///tmp/public-key.pem'],
        [
            '-----BEGIN PUBLIC KEY-----
            MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0llCeBjy18RylTdBih9G
            MUSZIC3GzeN0vQ9W8E3nwy2jdeUnH3GBXWpMo3F43V68zM2Qz5epRNmlLSkY/PJU
            fJIC8Yc1VEokT52q87hH/XJ5eS8heZnjuSlPAGi8oZ3ImVbruzV7XmlD+QsCSxJW
            7tBv0dqJ71e1gAAisCXK2m7iyf/ul6rT0Zz0ptYH4IZfwc/hQ9JcMg69uM+3bb4o
            BFsixMmEQwxKZsXk3YmO/YRjRbay+6+79bSV/frW+lWhknyGSIJp2CJArYcOdbK1
            bXx1dRWpbNSExo7dWwuPC0Y7a5AEeoZofieQPPBhXlp1hPgLYGat71pDqBjKLvF5
            GwIDAQAB
            -----END PUBLIC KEY-----'],
        ['$key'],
    ];

    public $source_code = '
        // enter a file name or a PEM key value ($_certificate)
        // or have a key generated with an optional config ($_configargs)
        $_key = openssl_pkey_new(
            $configargs // [array $configargs]
        );
        $details = openssl_pkey_get_details($key);
        $_certificate = $details["key"];

        inject_function_call

        // shows the key details, plus the rsa, dsa or dh key details in hexadecimal
        $array = openssl_pkey_get_details($resource);
        $hex = array_map("bin2hex", $this->result["array"]["rsa"]);
    ';

    public $synopsis = 'resource openssl_pkey_get_public ( mixed $certificate )';

    public $test_not_validated = 2;

    function pre_exec_function()
    {
        $configargs = $this->_filter->filter_arg_value('configargs');

        if (! $this->result['key'] = openssl_pkey_new($configargs)) {
            return;
        }

        $details = openssl_pkey_get_details($this->result['key']);

        $certificate = $this->_filter->filter_arg_value('certificate', false);

        if ($certificate == '$key') {
            $this->returned_params['certificate'] = $details['key'];
        }

        if (! file_exists('/tmp/public-key.pem')) {
            copy("$this->application_path/data/public-key.pem", '/tmp/public-key.pem');
        }
    }
}
