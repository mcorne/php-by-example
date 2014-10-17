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

class ctype_space extends function_core
{
    public $examples = ['_DOUBLE_QUOTES_\n\r\t_DOUBLE_QUOTES_', '_DOUBLE_QUOTES_\narf12_DOUBLE_QUOTES_', '_SINGLE_QUOTE_\n\r\t_SINGLE_QUOTE_'];

    public $synopsis = 'bool ctype_space ( string $text )';
}
