<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_popcount.php';

class gmp_scan1 extends gmp_popcount
{
    public $examples = [
        [
            'number' => "01000",
            'base'   => 2,
            '$a',
            0
        ],
        [
            'number' => "01000001111",
            'base'   => 2,
            '$a',
            5
        ],
    ];

    public $synopsis = 'int gmp_scan1 ( resource $a , int $start )';
}
