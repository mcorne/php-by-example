<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class iconv_mime_encode extends function_core
{
    public $examples = [
        [
            "Subject", "Prüfung Prüfung",
            [
                'input-charset' => 'UTF-8',
                'output-charset' => 'UTF-8',
                'line-length' => 76,
                'line-break-chars' => '_DOUBLE_QUOTES_\n_DOUBLE_QUOTES_',
                'scheme' => 'Q',
            ]
        ],
        [
            "Subject", "Prüfung Prüfung",
            [
                'input-charset' => 'UTF-8',
                'output-charset' => 'ISO-8859-1',
                'line-length' => 76,
                'line-break-chars' => '_DOUBLE_QUOTES_\n_DOUBLE_QUOTES_',
                'scheme' => 'B',
            ]
        ]
    ];

    public $source_code = '
inject_function_call

// enter non ASCII chars in hex in the fields if the charset is not UTF-8
';

    public $synopsis = 'string iconv_mime_encode ( string $field_name , string $field_value [, array $preferences = NULL ] )';
}
