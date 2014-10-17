<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_popcount.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class gmp_testbit extends gmp_popcount
{
    public $examples = [
        [
            'number' => "1000000",
            'base'   => 2,
            '$a',
            1
        ],
        [
            'number' => "1000010",
            'base'   => 2,
            '$a',
            1
        ],
    ];

    public $synopsis = 'bool gmp_testbit ( resource $a , int $index )';
}
