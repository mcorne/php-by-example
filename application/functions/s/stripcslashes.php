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

class stripcslashes extends function_core
{
    public $examples = ['_SINGLE_QUOTE_Hello world!\n Is\ anybody there?_SINGLE_QUOTE_'];

    public $synopsis = 'string stripcslashes ( string $str )';
}
