<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/g/getmyuid.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class posix_getuid extends getmyuid
{
    public $synopsis = 'int posix_getuid ( void )';
}
