<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'cal_days_in_month.php';

class cal_to_jd extends cal_days_in_month
{
    public $examples = [
        ['CAL_GREGORIAN', 1, 1, 2000]
    ];

    public $synopsis = 'int cal_to_jd ( int $calendar , int $month , int $day , int $year )';
}
