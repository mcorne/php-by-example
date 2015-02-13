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

class mcrypt_encrypt extends function_core
{
    public $constant_prefix = [
        'cipher' => 'MCRYPT',
        'mode'   => 'MCRYPT_MODE',
    ];

    public $examples = [
        [
            'MCRYPT_RIJNDAEL_128',
            'some 16 byte key',
            'This string was AES-128 / CBC / ZeroBytePadding encrypted.',
            'MCRYPT_MODE_CBC',
            'some 16 byte iv.',
        ],
    ];

    public $source_code = '
        inject_function_call

        // shows the result in hexadecimal and decrypted
        $hex = bin2hex($string);
        $decrypted = mcrypt_decrypt($cipher, $key, $string, $mode, $iv);
    ';

    public $synopsis = 'string mcrypt_encrypt ( string $cipher , string $key , string $data , string $mode [, string $iv ] )';

    function post_exec_function()
    {
        $this->result['hex'] = bin2hex($this->result['string']);

        $cipher = $this->_filter->filter_arg_value('cipher');
        $key    = $this->_filter->filter_arg_value('key');
        $mode   = $this->_filter->filter_arg_value('mode');
        $iv     = $this->_filter->filter_arg_value('iv');

        if (is_null($iv)) {
            $this->result['decrypted'] = mcrypt_decrypt($cipher, $key, $this->result['string'], $mode);
        } else {
            $this->result['decrypted'] = mcrypt_decrypt($cipher, $key, $this->result['string'], $mode, $iv);
        }
    }
}
