<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mcrypt_list_algorithms extends function_core
{
    public $synopsis = 'array mcrypt_list_algorithms ([ string $lib_dir = ini_get(&quot;mcrypt.algorithms_dir&quot;) ] )';

    public $test_not_validated = true;
}
