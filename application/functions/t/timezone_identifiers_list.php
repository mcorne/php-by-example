<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/d/datetimezone__listidentifiers.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class timezone_identifiers_list extends datetimezone__listidentifiers
{
    public $synopsis = 'array timezone_identifiers_list ([ int $what = DateTimeZone::ALL [, string $country = NULL ]] )';
}
