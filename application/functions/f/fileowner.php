<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/g/getmyuid.php';

class fileowner extends getmyuid
{
    public $examples = [__FILE__, "/path/to/foo.txt"];

    public $synopsis = 'int fileowner ( string $filename )';
}
