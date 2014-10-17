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

class usleep extends function_core
{
    public $examples = [2000000];

    public $synopsis = 'void usleep ( int $micro_seconds )';

    public $test_not_to_run = true;
}
