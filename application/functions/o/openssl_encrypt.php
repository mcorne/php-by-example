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

class openssl_encrypt extends function_core
{
    public $constant_prefix = ['options' => 'OPENSSL'];

    public $examples = [
        [
            'This string was AES-128 / ECB encrypted.',
            'AES-128-ECB',
            'some password',
        ],
        [
            'This string was AES-128 / CBC encrypted.',
            'AES-128-CBC',
            'some password',
            'OPENSSL_RAW_DATA',
            'some 16 byte iv.',
        ],
    ];

    public $options_getter = ['method' => 'openssl_get_cipher_methods'];

    public $source_code = '
        inject_function_call

        // shows the result in base64 and decrypted
        if ($options & OPENSSL_RAW_DATA) {
            $base64 = base64_encode($string);
        }
        $decrypted = openssl_decrypt($string, $method, $password, $options, $iv);
    ';

    public $synopsis = 'string openssl_encrypt ( string $data , string $method , string $password [, int $options = 0 [, string $iv = &quot;&quot; ]] )';

    function post_exec_function()
    {
        $method   = $this->_filter->filter_arg_value('method');
        $password = $this->_filter->filter_arg_value('password');
        $options  = $this->_filter->filter_arg_value('options');
        $iv       = $this->_filter->filter_arg_value('iv');

        if ($options & OPENSSL_RAW_DATA) {
            $this->result['base64'] = base64_encode($this->result['string']);
        }

        if (is_null($options)) {
            $this->result['decrypted'] = openssl_decrypt($this->result['string'], $method, $password);

        } elseif (is_null($iv)) {
            $this->result['decrypted'] = openssl_decrypt($this->result['string'], $method, $password, $options);

        } else {
            $this->result['decrypted'] = openssl_decrypt($this->result['string'], $method, $password, $options, $iv);
        }
    }
}
