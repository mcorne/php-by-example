<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class image_type_to_extension extends function_core
{
    public $constant_prefix = ['imagetype' => 'IMAGETYPE'];

    public $examples = ['IMAGETYPE_GIF'];

    public $synopsis = 'string image_type_to_extension ( int $imagetype [, bool $include_dot = TRUE ] )';
}
