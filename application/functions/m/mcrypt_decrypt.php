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

class mcrypt_decrypt extends function_core
{
    public $constant_prefix = [
        'e_cipher' => 'MCRYPT',
        'e_mode'   => 'MCRYPT_MODE',
        'cipher'   => 'MCRYPT',
        'mode'     => 'MCRYPT_MODE',
    ];

    public $examples = [
        [
            'e_cipher' => 'MCRYPT_RIJNDAEL_128',
            'e_key'    => 'some 16 byte key',
            'e_data'   => 'This string was AES-128 / CBC / ZeroBytePadding encrypted.',
            'e_mode'   => 'MCRYPT_MODE_CBC',
            'e_iv'     => 'some 16 byte iv.',
            'hex'      => '$hex',
            'MCRYPT_RIJNDAEL_128',
            'some 16 byte key',
            '$data',
            'MCRYPT_MODE_CBC',
            'some 16 byte iv.',
        ],
        [
            'e_cipher' => 'MCRYPT_RIJNDAEL_128',
            'e_key'    => 'some 16 byte key',
            'e_data'   => null,
            'e_mode'   => 'MCRYPT_MODE_CBC',
            'e_iv'     => 'some 16 byte iv.',
            'hex'      => 'b321df8a1e52b524a6aee756800ff45403478f0628fc63828c81467233a9401d7bd0c12c465b659731ed533fa4a1d7143d63a5ce3539316fb05b672e7502a263',
            'MCRYPT_RIJNDAEL_128',
            'some 16 byte key',
            '$data',
            'MCRYPT_MODE_CBC',
            'some 16 byte iv.',
        ],
        [
            'e_cipher' => 'MCRYPT_RIJNDAEL_128',
            'e_key'    => 'some 16 byte key',
            'e_data'   => null,
            'e_mode'   => 'MCRYPT_MODE_NOFB',
            'e_iv'     => 'some 16 byte iv.',
            'hex'      => null,
            'MCRYPT_RIJNDAEL_128',
            'some 16 byte key',
            '_DOUBLE_QUOTES_\x94\x60\x54_DOUBLE_QUOTES_',
            'MCRYPT_MODE_NOFB',
            'some 16 byte iv.',
        ],
    ];

    public $input_args = [
        'e_cipher',
        'e_key',
        'e_data',
        'e_mode',
        'e_iv',
    ];

    public $no_input_args = 'data';

    public $source_code = '
        // enter a string to encrypt ($_e_data),
        // or a string encrypted in hexadecimal ($_hex) or binary ($_data)

        $_encrypted = mcrypt_encrypt(
            $e_cipher, // string $e_cipher
            $e_key, // string $e_key
            $e_data, // string $e_data
            $e_mode, // string $e_mode
            $e_iv // [string $e_iv]
        );

        $_hex = bin2hex($_encrypted);

        $_data = hex2bin(
            $hex  // string $hex
        );

        inject_function_call
    ';

    public $synopsis = 'string mcrypt_decrypt ( string $cipher , string $key , string $data , string $mode [, string $iv ] )';

    function pre_exec_function()
    {
        if ($this->_filter->filter_arg_value('data')) {
            return;
        }

        if ($hex = $this->_filter->filter_arg_value('hex')) {
            $this->returned_params['data'] = hex2bin($hex);
            return;
        }

        $cipher = $this->_filter->filter_arg_value('e_cipher');
        $key    = $this->_filter->filter_arg_value('e_key');
        $data   = $this->_filter->filter_arg_value('e_data');
        $mode   = $this->_filter->filter_arg_value('e_mode');
        $iv     = $this->_filter->filter_arg_value('e_iv');

        if (is_null($iv)) {
            $this->returned_params['data'] = mcrypt_encrypt($cipher, $key, $data, $mode);
        } else {
            $this->returned_params['data'] = mcrypt_encrypt($cipher, $key, $data, $mode, $iv);
        }

        $this->result['hex'] = bin2hex($this->returned_params['data']);
    }
}
