<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class extension_loaded extends function_core
{
    public $examples = ["gd"];

    public $options_getter = ['name' => 'get_loaded_extensions'];

    public $synopsis = 'bool extension_loaded ( string $name )';
}
