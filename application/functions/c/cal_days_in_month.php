<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// this class is extended by other classes

class cal_days_in_month extends function_core
{
    public $examples = [
        ['CAL_GREGORIAN', 8, 2003]
    ];

    public $constant_prefix = ['calendar' => 'CAL'];

    public $synopsis = 'int cal_days_in_month ( int $calendar , int $month , int $year )';
}
