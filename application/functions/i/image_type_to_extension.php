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

class image_type_to_extension extends function_core
{
    public $constant_prefix = ['imagetype' => 'IMAGETYPE'];

    public $examples = ['IMAGETYPE_GIF'];

    public $synopsis = 'string image_type_to_extension ( int $imagetype [, bool $include_dot = TRUE ] )';
}
