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

class openssl_pkey_get_details extends function_core
{
    public $examples = [
        ['$key'],
        [
            'configargs' => [
                'digest_alg'       => 'sha512',
                'private_key_bits' => 4096,
                'private_key_type' => 'OPENSSL_KEYTYPE_RSA',
            ],
            '$key',
        ],
    ];

    public $input_args = ['configargs'];

    public $source_code = '
        $_key = openssl_pkey_new(
            $configargs // [array $configargs]
        );

        inject_function_call

        // shows the rsa, dsa or dh key details in hexadecimal
        $hex = array_map("bin2hex", $this->result["array"]["rsa"]);
    ';

    public $synopsis = 'array openssl_pkey_get_details ( resource $key )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        if (isset($this->result['array'])) {
            if (isset($this->result['array']['rsa'])) {
                $this->result['hex'] = array_map('bin2hex', $this->result['array']['rsa']);

            } elseif (isset($this->result['array']['dsa'])) {
                $this->result['hex'] = array_map('bin2hex', $this->result['array']['dsa']);

            } elseif (isset($this->result['array']['dh'])) {
                $this->result['hex'] = array_map('bin2hex', $this->result['array']['dh']);
            }
        }
    }

    function pre_exec_function()
    {
        $configargs = $this->_filter->filter_arg_value('configargs');
        $this->returned_params['key'] = openssl_pkey_new($configargs);
    }
}
