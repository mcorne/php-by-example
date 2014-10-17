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

class convert_uudecode extends function_core
{
    public $examples = ['_DOUBLE_QUOTES_+22!L;W9E(%!(4\"$`\n`_DOUBLE_QUOTES_'];

    public $synopsis = 'string convert_uudecode ( string $data )';
}
