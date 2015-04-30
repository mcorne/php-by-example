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

class openssl_pkey_get_public extends function_core
{
    public $examples = [
        ['$key'],
    ];

    public $source_code = '
        $_key = openssl_pkey_new(
            $configargs // [array $configargs]
        );
        $details = openssl_pkey_get_details($key);
        $_certificate = $details["key"];

        inject_function_call
    ';

    public $synopsis = 'resource openssl_pkey_get_public ( mixed $certificate )';

    function pre_exec_function()
    {
        $configargs = $this->_filter->filter_arg_value('configargs');

        if (! $this->result['key'] = openssl_pkey_new($configargs)) {
            return;
        }

        $details = openssl_pkey_get_details($this->result['key']);
        $this->returned_params['certificate'] = $details['key'];
    }
}
