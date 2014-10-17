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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class file_exists extends function_core
{
    public $examples = [__FILE__, "/path/to/foo.txt"];

    public $synopsis = 'bool file_exists ( string $filename )';

    public $test_not_validated = [0];
}
