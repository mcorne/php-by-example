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

class posix_getegid extends getmygid
{
    public $synopsis = 'int posix_getegid ( void )';
}
