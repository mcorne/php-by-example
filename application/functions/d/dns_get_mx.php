<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/g/getmxrr.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class dns_get_mx extends getmxrr
{
    public $synopsis = 'bool dns_get_mx ( string $hostname , array &$mxhosts [, array &$weight ] )';
}
