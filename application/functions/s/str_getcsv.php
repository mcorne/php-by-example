<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class str_getcsv extends function_core
{
    public $examples = [
        ['red,blue,yellow,green'],
        [
            '_SINGLE_QUOTE_red;blue;"dark orange";green_SINGLE_QUOTE_',
            ';',
            '_SINGLE_QUOTE_"_SINGLE_QUOTE_'
        ]
    ];

    public $synopsis = 'array str_getcsv ( string $input [, string $delimiter = &#039;,&#039; [, string $enclosure = &#039;&quot;&#039; [, string $escape = &#039;\\&#039; ]]] )';
}
