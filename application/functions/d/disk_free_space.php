<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class disk_free_space extends function_core
{
    public $examples = ["/", "C:", "D:"];

    public $synopsis = 'float disk_free_space ( string $directory )';

    public $test_always_valid = true;
}
