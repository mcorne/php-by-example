<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class dirname extends function_core
{
    public $examples = ["/etc/passwd", "/etc/", ".", "c:/", "c:/x", "c:/Temp/x", "/x"];

    public $synopsis = 'string dirname ( string $path )';

    public $test_always_valid = [1, 3, 4, 6];
}
