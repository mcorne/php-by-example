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

class sleep extends function_core
{
    public $examples = [3];

    public $synopsis = 'int sleep ( int $seconds )';

    public $test_not_to_run = true;
}
