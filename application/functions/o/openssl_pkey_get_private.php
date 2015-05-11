<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'openssl_pkey_new.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class openssl_pkey_get_private extends openssl_pkey_new
{
    public $examples = [
        [
            // openssl genrsa -passout -out private-key-with-pass.pem 2048
            'file:///tmp/private-key.pem',
        ],
        [
            // openssl genrsa -aes128 -passout pass:"this is a passphrase" -out private-key-with-pass.pem 2048
            'file:///tmp/private-key-with-pass.pem',
            'this is a passphrase',
        ],
        [
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

    public $synopsis = 'resource openssl_pkey_get_private ( mixed $key [, string $passphrase = &quot;&quot; ] )';

    function pre_exec_function()
    {
        $key = $this->_filter->filter_arg_value('key', false);

        if (is_string($key) and preg_match('~^file://~', $key)) {
            $this->_filter->is_temp_filename($key);
        }

        $this->copy_file_to_temp('private-key.pem');
        $this->copy_file_to_temp('private-key-with-pass.pem');
    }
}
