<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class file_exists extends function_core
{
    public $examples = [__FILE__, "/path/to/foo.txt"];

    public $synopsis = 'bool file_exists ( string $filename )';

    public $test_not_validated = [0];
}
