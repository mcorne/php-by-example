<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_popcount.php';

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
