<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class iconv_get_encoding extends function_core
{
    public $examples = ["all"];

    public $options_list = ['type' => ['all', 'input_encoding', 'output_encoding', 'internal_encoding']];

    public $synopsis = 'mixed iconv_get_encoding ([ string $type = &quot;all&quot; ] )';
}
