<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'cal_days_in_month.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class cal_info extends cal_days_in_month
{
    public $examples = [0];

    public $synopsis = 'array cal_info ([ int $calendar = -1 ] )';
}
