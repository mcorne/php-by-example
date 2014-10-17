<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class iconv_get_encoding extends function_core
{
    public $examples = ["all"];

    public $options_list = ['type' => ['all', 'input_encoding', 'output_encoding', 'internal_encoding']];

    public $synopsis = 'mixed iconv_get_encoding ([ string $type = &quot;all&quot; ] )';
}
