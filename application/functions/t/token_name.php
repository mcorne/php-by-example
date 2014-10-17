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

class token_name extends function_core
{
    public $constant_prefix = ['token' => 'T'];

    public $examples = [260, 'T_FUNCTION'];

    public $synopsis = 'string token_name ( int $token )';
}
