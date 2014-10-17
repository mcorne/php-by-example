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

class trigger_error extends function_core
{
    public $examples = [
        [
            "Cannot divide by zero",
            'E_USER_ERROR'
        ],
    ];

    public $synopsis = 'bool trigger_error ( string $error_msg [, int $error_type = E_USER_NOTICE ] )';
}
