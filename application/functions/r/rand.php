<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class rand extends function_core
{
    public $examples = [
        [],
        [5, 15]
    ];

    // public $synopsis    = 'int rand ( void )';
    public $synopsis       = 'int rand ( int $min , int $max )';
    public $synopsis_fixed = 'int rand ( [ int $min [, int $max ]] )';

    public $test_always_valid = true;
}
