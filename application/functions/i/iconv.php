<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class iconv extends function_core
{
    public $examples = [
        [
            "UTF-8",
            "ISO-8859-1//TRANSLIT",
            "This is the Euro symbol '€'.",
        ],
        [
            "UTF-8",
            "ISO-8859-1//IGNORE",
            "This is the Euro symbol '€'.",
        ],
        // used in translations_in_action.php
        [
            "UTF-8",
            "ISO-8859-1",
            "This is the Euro symbol '€'.",
        ],
        [
            "UTF-8",
            "ISO-8859-1",
            'à',
        ],
        [
            "ISO-8859-1",
            "UTF-8",
            '_DOUBLE_QUOTES_\xe0_DOUBLE_QUOTES_', // "à" in ISO
        ],
    ];

    public $options_getter = [
        'in_charset'  => 'mb_list_encodings',
        'out_charset' => 'mb_list_encodings',
    ];

    public $source_code = '
        inject_function_call

        // enter non ASCII characters in hex in $_str if $_in_charset is not UTF-8
        // the converted $_string may not display properly if $_out_charset is not UTF-8

        // shows the encoding difference in hexadecimal
        // note that $str below actually represents an argument
        $hex = unpack("H*in_charset", $_str) + unpack("H*out_charset", $_string);
    ';

    public $synopsis = 'string iconv ( string $in_charset , string $out_charset , string $str )';

    function post_exec_function()
    {
         $str = $this->_filter->filter_arg_value('str');
         $string = $this->result['string'];
         $this->result['hex'] = unpack("H*in__charset", $str) + unpack("H*out_charset", $string);
    }
}
