<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'disk_free_space.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class diskfreespace extends disk_free_space
{
    public $synopsis = 'float diskfreespace ( string $directory )';
}
