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

class openssl_decrypt extends function_core
{
    public $constant_prefix = [
        'e_options' => 'OPENSSL',
        'options'   => 'OPENSSL',
    ];

    public $examples = [
        [
            'eXIp3BnsELdTuTvVkpoFqXuYoP6zd73ETDXiNcMhXUiuAm0ju4ufdX9Yxai4X7S3',
            'AES-128-ECB',
            'some password',
        ],
        [
            'e_data'     => 'This string was AES-128 / ECB encrypted.',
            'e_method'   => 'AES-128-ECB',
            'e_password' => 'some password',
            '$data',
            'AES-128-ECB',
            'some password',
        ],
        [
            'e_data'     => 'This string was AES-128 / ECB encrypted.',
            'e_method'   => 'AES-128-ECB',
            'e_password' => 'some password',
            'e_options'  => 'OPENSSL_RAW_DATA',
            '$data',
            'AES-128-ECB',
            'some password',
            'OPENSSL_RAW_DATA',
        ],
    ];

    public $input_args = [
        'e_data',
        'e_method',
        'e_options',
        'e_password',
        'e_iv',
    ];

    public $options_getter = [
        'e_method' => 'openssl_get_cipher_methods',
        'method'   => 'openssl_get_cipher_methods',
    ];

    public $source_code = '
        // enter a string to encrypt ($_e_data) or the string encrypted ($_data)

        $_data = openssl_encrypt(
            $e_data, // string $e_data
            $e_method, // string $e_method
            $e_password, // string $e_password
            $e_options, // [int $e_options]
            $e_iv // [string $e_iv]
        );

        inject_function_call

        // shows the data in base64
        if ($e_options & OPENSSL_RAW_DATA) {
            $base64 = base64_encode($data);
        }
    ';

    public $synopsis = 'string openssl_decrypt ( string $data , string $method , string $password [, int $options = 0 [, string $iv = &quot;&quot; ]] )';

    function pre_exec_function()
    {
        if ($this->_filter->filter_arg_value('data')) {
            return;
        }

        $data     = $this->_filter->filter_arg_value('e_data');
        $method   = $this->_filter->filter_arg_value('e_method');
        $password = $this->_filter->filter_arg_value('e_password');
        $options  = $this->_filter->filter_arg_value('e_options');
        $iv       = $this->_filter->filter_arg_value('e_iv');

        if (is_null($options)) {
            $this->returned_params['data'] = openssl_encrypt($data, $method, $password);

        } elseif (is_null($iv)) {
            $this->returned_params['data'] = openssl_encrypt($data, $method, $password, $options);

        } else {
            $this->returned_params['data'] = openssl_encrypt($data, $method, $password, $options, $iv);
        }

        $this->result['data'] = $this->returned_params['data'];

        if ($options & OPENSSL_RAW_DATA) {
            $this->result['base64'] = base64_encode($this->result['data']);
        }
    }
}
