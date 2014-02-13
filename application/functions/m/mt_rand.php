<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class mt_rand extends function_core
{
    public $examples = [
        [],
        [5, 15]
    ];

    // public $synopsis    = 'int mt_rand ( void )';
    public $synopsis       = 'int mt_rand ( int $min , int $max )';
    public $synopsis_fixed = 'int mt_rand ( [ int $min [, int $max ]] )';

    public $test_not_validated = true;
}
