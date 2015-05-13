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

class openssl_pkey_export extends function_core
{
    public $examples = [
        [
            '$key',
            '$out',
            'this is a passphrase',
        ],
        [
            'n_configargs' => [
                'digest_alg'       => 'sha512',
                'private_key_bits' => 4096,
                'private_key_type' => 'OPENSSL_KEYTYPE_RSA',
            ],
            '$key',
            '$out',
        ],
    ];

    public $input_args = ['n_configargs'];

    public $no_input_args = 'key';

    public $source_code = '
        $_key = openssl_pkey_new(
            $n_configargs // [array $n_configargs]
        );

        inject_function_call
    ';

    public $synopsis = 'bool openssl_pkey_export ( mixed $key , string &$out [, string $passphrase [, array $configargs ]] )';

    public $test_not_validated = true;

    function pre_exec_function()
    {
        $configargs = $this->_filter->filter_arg_value('n_configargs');
        $this->returned_params['key'] = openssl_pkey_new($configargs);
    }
}
