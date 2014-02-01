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
        ["Subject", "Prüfung Prüfung",
            [
                'input-charset' => 'UTF-8',
                'output-charset' => 'UTF-8',
                'line-length' => 76,
                'line-break-chars' => "\n",
                'scheme' => 'Q',
            ]
        ],
        ["Subject", "Prüfung Prüfung",
            [
                'input-charset' => 'UTF-8',
                'output-charset' => 'ISO-8859-1',
                'line-length' => 76,
                'line-break-chars' => "\n",
                'scheme' => 'B',
            ]
        ]
    ];

    public $synopsis = 'string iconv_mime_encode ( string $field_name , string $field_value [, array $preferences = NULL ] )';
}
