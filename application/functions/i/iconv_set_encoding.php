<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class iconv_set_encoding extends function_core
{
    public $examples = [
        ["internal_encoding", "UTF-8"],
        ["output_encoding", "ISO-8859-1"]
    ];

    public $synopsis = 'bool iconv_set_encoding ( string $type , string $charset )';
}
