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

class is_string extends function_core
{
    public $examples = [false, true, null, 'abc', '23', 23, '23.5', 23.5, '', ' ', '0', 0];

    public $synopsis = 'bool is_string ( mixed $var )';
}
