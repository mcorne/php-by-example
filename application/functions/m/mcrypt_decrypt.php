<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'custom/pbx_base64_to_hex.php';
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
            'MCRYPT_RIJNDAEL_128',
            'some 16 byte key',
            // base 64 data to be converted to hexadecimal notation, see init()
            'syHfih5StSSmrudWgA/0VANHjwYo/GOCjIFGcjOpQB170MEsRltllzHtUz+kodcUPWOlzjU5MW+wW2cudQKiYw==',
            'MCRYPT_MODE_CBC',
            'some 16 byte iv.',
        ],
        [
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
    ];

    public $input_args = [
        'base64',
        'e_cipher',
        'e_key',
        'e_data',
        'e_mode',
        'e_iv',
    ];

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

    function init()
    {
        $this->examples[0][2] = '_DOUBLE_QUOTES_' . pbx_base64_to_hex($this->examples[0][2], true) . '_DOUBLE_QUOTES_';
    }

    function pre_exec_function()
    {
        if ($this->_filter->filter_arg_value('data')) {
            return;
        }

        if ($base64 = $this->_filter->filter_arg_value('base64')) {
            $this->result['data'] =  $this->returned_params['data'] = base64_decode($base64);
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

        $this->result['data'] =  $this->result['base64'] = base64_encode($this->returned_params['data']);
    }
}
