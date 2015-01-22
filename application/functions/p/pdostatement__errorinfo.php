<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/p/pdostatement__errorcode.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class pdostatement__errorinfo extends pdostatement__errorcode
{
    public $synopsis = 'public array PDOStatement::errorInfo ( void )';
}
