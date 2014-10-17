<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/g/getmygid.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class filegroup extends getmygid
{
    public $examples = [__FILE__, "/path/to/foo.txt"];

    public $synopsis = 'int filegroup ( string $filename )';
}
