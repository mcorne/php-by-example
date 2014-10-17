<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'date_sunrise.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class date_sunset extends date_sunrise
{
    public $synopsis = 'mixed date_sunset ( int $timestamp [, int $format = SUNFUNCS_RET_STRING [, float $latitude = ini_get(&quot;date.default_latitude&quot;) [, float $longitude = ini_get(&quot;date.default_longitude&quot;) [, float $zenith = ini_get(&quot;date.sunset_zenith&quot;) [, float $gmt_offset = 0 ]]]]] )';
}
