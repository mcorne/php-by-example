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

class is_float extends function_core
{
    public $examples = [27.25, "abc", 23, 23.5, '_NO_QUOTE_1e7', true];

    public $synopsis = 'bool is_float ( mixed $var )';
}
