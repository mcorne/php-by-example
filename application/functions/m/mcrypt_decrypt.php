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
            'base64'   => '$base64',
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
            'base64'   => 'syHfih5StSSmrudWgA/0VANHjwYo/GOCjIFGcjOpQB170MEsRltllzHtUz+kodcUPWOlzjU5MW+wW2cudQKiYw==',
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
            'base64'   => null,
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
        // or a string encrypted in base64 ($_base64) or binary ($_data)

        $_encrypted = mcrypt_encrypt(
            $e_cipher, // string $e_cipher
            $e_key, // string $e_key
            $e_data, // string $e_data
            $e_mode, // string $e_mode
            $e_iv // [string $e_iv]
        );

        $_base64 = base64_encode($_encrypted);

        $_data = base64_decode(
            $base64  // string $base64
        );

        inject_function_call
    ';

    public $synopsis = 'string mcrypt_decrypt ( string $cipher , string $key , string $data , string $mode [, string $iv ] )';

    function pre_exec_function()
    {
        if ($this->_filter->filter_arg_value('data')) {
            return;
        }

        if ($base64 = $this->_filter->filter_arg_value('base64')) {
            $this->returned_params['data'] = base64_decode($base64);
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

        $this->result['base64'] = base64_encode($this->returned_params['data']);
    }
}
