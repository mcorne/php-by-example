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

class gethostbynamel extends function_core
{
    public $examples = ["www.example.com"];

    public $synopsis = 'array gethostbynamel ( string $hostname )';

    public $test_not_to_run = true;
}
