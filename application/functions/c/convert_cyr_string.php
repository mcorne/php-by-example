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

class convert_cyr_string extends function_core
{
    const CHARSETS = [
        ['k', 'koi8-r'],
        ['w', 'windows-1251'],
        ['i', 'iso8859-5'],
        ['a', 'x-cp866'],
        ['d', 'x-cp866'],
        ['m', 'x-mac-cyrillic'],
    ];

    public $commented_options = ['from' => self::CHARSETS, 'to' => self::CHARSETS];

    public $examples = [
        [
            '_DOUBLE_QUOTES_\x70\xF0_DOUBLE_QUOTES_', // pП
            'k',
            'i',
        ],
    ];

    public $source_code = '
        inject_function_call

        // shows the result in hexadecimal
        $hex = bin2hex($string);
    ';

    public $synopsis = 'string convert_cyr_string ( string $str , string $from , string $to )';

    function post_exec_function()
    {
        $this->result['hex'] = bin2hex($this->result['string']);
    }
}
