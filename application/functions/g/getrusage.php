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

class getrusage extends function_core
{
    public $options_range = ['who' => [0, 1]];

    public $synopsis = 'array getrusage ([ int $who = 0 ] )';

    public $test_not_validated = true;
}
