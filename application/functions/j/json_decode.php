<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class json_decode extends function_core
{
    public $examples = [
        '_SINGLE_QUOTE_{"a":1,"b":2,"c":3,"d":4,"e":5}_SINGLE_QUOTE_',
        [
            '_SINGLE_QUOTE_{"a":1,"b":2,"c":3,"d":4,"e":5}_SINGLE_QUOTE_',
            true
        ],
        '_SINGLE_QUOTE_{"foo-bar": 12345}_SINGLE_QUOTE_',
        "{ 'bar': 'baz' }",
        '_SINGLE_QUOTE_{ bar: "baz" }_SINGLE_QUOTE_',
        '_SINGLE_QUOTE_{ bar: "baz", }_SINGLE_QUOTE_',
        '_SINGLE_QUOTE_{"1":{"English":["One","January"],"French":["Une","Janvier"]}}_SINGLE_QUOTE_',
        '_SINGLE_QUOTE_{"number": 12345678901234567890}_SINGLE_QUOTE_',
        [
            '_SINGLE_QUOTE_{"number": 12345678901234567890}_SINGLE_QUOTE_',
            false,
            512,
            'JSON_BIGINT_AS_STRING'
        ]
    ];

    public $synopsis = 'mixed json_decode ( string $json [, bool $assoc = false [, int $depth = 512 [, int $options = 0 ]]] )';
}
