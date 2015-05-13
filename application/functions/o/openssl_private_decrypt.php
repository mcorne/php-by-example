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

class openssl_private_decrypt extends function_core
{
    public $constant_prefix = ['e_padding' => 'OPENSSL'];

    public $examples = [
        [
            // base 64 data to be converted to hexadecimal notation, see init()
            'uJqMJhkKJMHzep104yj/95mYHdHvvI41VtVB5Af2qbfFZ76cwZFhvmYZEW1BuhLeAoETVDfua0wq4W6BAjVB3OqBf8vkSOhZb2fUmMBHb2w8E/hZSXNGedJFXxM2WRuX/bQWo6Qx7g8suzCVB6H+jugd0tfOIn++ndlsQlWU+FEUHff1KSfmha5G6fqT+PAE0GybXxyCiqd6w6kWUdD0cBfWVuw79v8o8DoX5LbHoKh1DXEtMP3dW/3XSSygUJUCzmjsCcfWQJuyQqDk3WAQZWC64Vau7eGo8kZaVJsO+rTpb6qOzv+IyjPWTDn7jvwzRAt5mI8ZSjSA1RFKeJIYiw==',
            '$decrypted',
            'file:///tmp/private-key.pem',
        ],
        [
            'base64' => 'uJqMJhkKJMHzep104yj/95mYHdHvvI41VtVB5Af2qbfFZ76cwZFhvmYZEW1BuhLeAoETVDfua0wq4W6BAjVB3OqBf8vkSOhZb2fUmMBHb2w8E/hZSXNGedJFXxM2WRuX/bQWo6Qx7g8suzCVB6H+jugd0tfOIn++ndlsQlWU+FEUHff1KSfmha5G6fqT+PAE0GybXxyCiqd6w6kWUdD0cBfWVuw79v8o8DoX5LbHoKh1DXEtMP3dW/3XSSygUJUCzmjsCcfWQJuyQqDk3WAQZWC64Vau7eGo8kZaVJsO+rTpb6qOzv+IyjPWTDn7jvwzRAt5mI8ZSjSA1RFKeJIYiw==',
            '$data',
            '$decrypted',
            'file:///tmp/private-key.pem',
        ],
        [
            'e_data' => 'this is some data',
            'e_key'  => 'file:///tmp/public-key.pem',
            'base64' => '$base64',
            '$data',
            '$decrypted',
            'file:///tmp/private-key.pem',
        ],
        [
            'e_data' => 'this is some data',
            'e_key' =>
                '-----BEGIN PUBLIC KEY-----
                MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0llCeBjy18RylTdBih9G
                MUSZIC3GzeN0vQ9W8E3nwy2jdeUnH3GBXWpMo3F43V68zM2Qz5epRNmlLSkY/PJU
                fJIC8Yc1VEokT52q87hH/XJ5eS8heZnjuSlPAGi8oZ3ImVbruzV7XmlD+QsCSxJW
                7tBv0dqJ71e1gAAisCXK2m7iyf/ul6rT0Zz0ptYH4IZfwc/hQ9JcMg69uM+3bb4o
                BFsixMmEQwxKZsXk3YmO/YRjRbay+6+79bSV/frW+lWhknyGSIJp2CJArYcOdbK1
                bXx1dRWpbNSExo7dWwuPC0Y7a5AEeoZofieQPPBhXlp1hPgLYGat71pDqBjKLvF5
                GwIDAQAB
                -----END PUBLIC KEY-----',
            '$data',
            '$decrypted',
            '-----BEGIN RSA PRIVATE KEY-----
            MIIEogIBAAKCAQEA0llCeBjy18RylTdBih9GMUSZIC3GzeN0vQ9W8E3nwy2jdeUn
            H3GBXWpMo3F43V68zM2Qz5epRNmlLSkY/PJUfJIC8Yc1VEokT52q87hH/XJ5eS8h
            eZnjuSlPAGi8oZ3ImVbruzV7XmlD+QsCSxJW7tBv0dqJ71e1gAAisCXK2m7iyf/u
            l6rT0Zz0ptYH4IZfwc/hQ9JcMg69uM+3bb4oBFsixMmEQwxKZsXk3YmO/YRjRbay
            +6+79bSV/frW+lWhknyGSIJp2CJArYcOdbK1bXx1dRWpbNSExo7dWwuPC0Y7a5AE
            eoZofieQPPBhXlp1hPgLYGat71pDqBjKLvF5GwIDAQABAoIBACPItYsSy3UzYT7L
            OKYTrfBBuD8GKpTqBfkHvAWDa1MD15P92Mr7l0NaCxGfAy29qSa6LdFy/oPM9tGY
            9TxKyV6rxD5sfwEI3+Z/bw6pIe4W5F1eTDaQnHHqehsatkRUQET9yXp+na8w/zRF
            0C0PQKS95tfvcpm59RGCdGQ8+aZw+cIy/xez75W8IS/hagMxe7xYPjpkOkSCCEJU
            zmbVq6AyWodASV0p4H9p8I+c0vO2hJ/ELJ167w6T+2/GlZg979rlyHoTW8jK2BbG
            IRGaPo+c2GANXa686tdpbkPd6oJliXwBSNolxmXShvlveBbPFAJJACzCmbXNj9kH
            6/K+SWkCgYEA7FNudcTkRPV8TzKhJ1AzDjw3VcnraYhY8IlNxbk7RVHLdkoUtwk/
            mImeBlEfCoz9V+S/gRgeQ+1Vb/BCbS24+bN/+IGoNRFMRcOieFt6lQUpj7a9NeSo
            IEclGgUiU7QR3xH73SB4GC3rgSPeHJhJZC5EJq5TzYjXTPGPpBD3zicCgYEA49wz
            zfMDYIH8h4L65r/eJYIbLwpvgktgaYvhijO3qfZSWW+Y19jCBn55f65YOhPGQBHA
            my0f+tVxFNZ/OupbrAIIzogxlCIYHNBawDhoHN/sB3/lSBAjifySNLyRlA62oA0w
            wXvXVLVWMa3aXim3c9AlnLF1fHwcvwpOKSfdye0CgYBb1mBKq+T5V1yjek1d9bCh
            i40FbZ5qOG43q2Ppvn3mBk9G/KroJlPsdy5NziB9/SRGj8JL7I92Xjihc4Cc5PPJ
            NZQ5gklXtg0p30i39PTCDGuGScFlvCIJyRwF7JDWblezlE2INSH2Y4HtgX7DJfr/
            T2t0jLJMYS0p3YWwgFeMaQKBgHUIe/8y6zAdc5QynSX5tGL1gXrW1FFK39k2RICU
            cag1YTSYkhuDNJzbRxJifORPlcsAkzngooVWLb+zMCQVjUI6xUU3RKe+Hz5lccc6
            8ZarGHL9qMkrqOVNudamZ+tw5zIrtDgcoIvcm8nmbrtgl94/MaJar2ph4O3qoByZ
            Ylw9AoGAIdS79s0VKkj4VVXqK47ZcI7jGL4V4C8ujU8YcMNV88xwCoDg9ZIFprWA
            P5p/cnvj6aHnqL58XiH0+bE0Lt3J+U6N6JelQQevgBHooMFh4FpDXcVda7xB3rK3
            woqbi8fNhr827H2maxIZPtVG95/mvR4k5z1Jrdnr34ZUmtC6U5Q=
            -----END RSA PRIVATE KEY-----',
        ],
    ];

    public $input_args = [
        'base64',
        'e_data',
        'e_key',
        'e_padding',
    ];

    public $source_code = '
        // enter a string to encrypt ($_e_data),
        // or a string encrypted in base64 ($_base64) or binary ($_data)
        $e_bool = openssl_public_encrypt(
            $e_data, // string $e_data,
            $_crypted,
            $e_key, // mixed $e_key
            $e_padding // [int $e_padding]);
        }

        $_base64 = base64_encode($_crypted);

        $_data = base64_decode(
            $base64  // string $base64
        );

        inject_function_call

        // shows the data in base64
        if ($e_bool) {
            $base64 = base64_encode($crypted);
        }
    ';

    public $synopsis = 'bool openssl_private_decrypt ( string $data , string &$decrypted , mixed $key [, int $padding = OPENSSL_PKCS1_PADDING ] )';

    function init()
    {
        $this->examples[0][0] = '_DOUBLE_QUOTES_' . pbx_base64_to_hex($this->examples[0][0], true) . '_DOUBLE_QUOTES_';
    }

    public $test_not_validated = [2, 3];

    function pre_exec_function()
    {
        $this->copy_file_to_temp('private-key.pem');
        $this->copy_file_to_temp('public-key.pem');

        if ($this->_filter->filter_arg_value('data')) {
            return;
        }

        if ($base64 = $this->_filter->filter_arg_value('base64')) {
            $this->result['data'] = $this->returned_params['data'] = base64_decode($base64);
            return;
        }

        $e_data    = $this->_filter->filter_arg_value('e_data');
        $e_key     = $this->_filter->filter_arg_value('e_key');
        $e_padding = $this->_filter->filter_arg_value('e_padding');

        if (is_null($e_padding)) {
            $this->result['e_bool'] = openssl_public_encrypt($e_data, $crypted, $e_key);
        } else {
            $this->result['e_bool'] = openssl_public_encrypt($e_data, $crypted, $e_key, $e_padding);
        }

        $this->result['data'] = $this->returned_params['data'] = $crypted;
        $this->result['base64'] = base64_encode($crypted);
    }
}
