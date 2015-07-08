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

class debug_print_backtrace extends function_core
{
    public $output_buffer = true;

    public $synopsis = 'void debug_print_backtrace ([ int $options = 0 [, int $limit = 0 ]] )';

    public $test_not_validated = true;
}
