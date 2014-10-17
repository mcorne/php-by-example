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

class gethostbyaddr extends function_core
{
    public $examples = ['127.0.0.1'];

    public $synopsis = 'string gethostbyaddr ( string $ip_address )';

    public $test_not_validated = true;
}
