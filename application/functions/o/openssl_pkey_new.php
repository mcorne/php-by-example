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

class openssl_pkey_new extends function_core
{
    public $examples = [
        [],
        [
            [
                'digest_alg'       => 'sha512',
                'private_key_bits' => 4096,
                'private_key_type' => 'OPENSSL_KEYTYPE_RSA',
            ],
        ],
    ];

    public $source_code = '
        inject_function_call

        // shows the key details, plus the rsa, dsa or dh key details in hexadecimal
        $array = openssl_pkey_get_details($resource);
        $hex = array_map("bin2hex", $this->result["array"]["rsa"]);
    ';

    public $synopsis = 'resource openssl_pkey_new ([ array $configargs ] )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        if ($this->result['resource']) {
            $this->result['array'] = openssl_pkey_get_details($this->result['resource']);

            if (isset($this->result['array']['rsa'])) {
                $this->result['hex'] = array_map('bin2hex', $this->result['array']['rsa']);

            } elseif (isset($this->result['array']['dsa'])) {
                $this->result['hex'] = array_map('bin2hex', $this->result['array']['dsa']);

            } elseif (isset($this->result['array']['dh'])) {
                $this->result['hex'] = array_map('bin2hex', $this->result['array']['dh']);
            }
        }
    }
}
