<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class phpversion extends function_core
{
    public $examples = [[], 'tidy'];

    public $options_getter = ['extension' => 'get_loaded_extensions'];

    public $synopsis = 'string phpversion ([ string $extension ] )';

    public $test_always_valid = true;
}
