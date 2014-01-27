<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class checkdate extends function_core
{
    public $examples = [
            [12, 31, 2000],
            [2, 29, 2001]
    ];

    public $synopsis = 'bool checkdate ( int $month , int $day , int $year )';
}
