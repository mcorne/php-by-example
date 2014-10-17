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

class disk_free_space extends function_core
{
    public $hash_result = true;

    public $examples = ["/", "C:", "D:"];

    public $synopsis = 'float disk_free_space ( string $directory )';

    public $test_not_validated = true;
}
