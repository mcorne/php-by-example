<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'timezone_location_get.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class timezone_name_get extends timezone_location_get
{
    public $synopsis = 'string timezone_name_get ( DateTimeZone $object )';
}
