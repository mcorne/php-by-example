<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/m/mktime.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class gmmktime extends mktime
{
    public $synopsis       = 'int gmmktime ([ int $hour = gmdate("H") [, int $minute = gmdate("i") [, int $second = gmdate("s") [, int $month = gmdate("n") [, int $day = gmdate("j") [, int $year = gmdate("Y") [, int $is_dst = -1 ]]]]]]] )';
    public $synopsis_fixed = 'int gmmktime ([ int $hour  [, int $minute  [, int $second  [, int $month  [, int $day  [, int $year  [, int $is_dst = -1 ]]]]]]] )';
}
