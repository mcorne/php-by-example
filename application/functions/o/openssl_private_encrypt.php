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

class openssl_private_encrypt extends function_core
{
    public $examples = [
        [
            'this is some data',
            '$crypted',
            '$key',
        ],
    ];

    public $input_args = ['configargs'];

    public $source_code = '
        $_key = openssl_pkey_new(
            $configargs // [array $configargs]
        );

        inject_function_call

        // shows the result in base64 and decrypted
        $base64 = base64_encode($crypted);
        $public = openssl_pkey_get_details($key);
        $d_bool = openssl_public_decrypt($data, &$decrypted, $public["key"], $padding);
    ';

    public $synopsis = 'bool openssl_private_encrypt ( string $data , string &$crypted , mixed $key [, int $padding = OPENSSL_PKCS1_PADDING ] )';

    function post_exec_function()
    {
        if (! $this->returned_params['key']) {
            return;
        }

        $this->result['base64'] = base64_encode($this->result['crypted']);

        $public = openssl_pkey_get_details($this->returned_params['key']);

        $padding = $this->_filter->filter_arg_value('$padding');

        if (is_null($padding)) {
            $this->result['d_bool'] = openssl_public_decrypt($this->result['crypted'], $decrypted, $public['key']);
        } else {
            $this->result['d_bool'] = openssl_public_decrypt($this->result['crypted'], $decrypted, $public['key'], $padding);
        }

        $this->result['decrypted'] = $decrypted;
    }

    function pre_exec_function()
    {
        $configargs = $this->_filter->filter_arg_value('configargs');
        $this->returned_params['key'] = openssl_pkey_new($configargs);
    }
}
