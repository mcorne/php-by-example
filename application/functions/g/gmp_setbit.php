<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'gmp_clrbit.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class gmp_setbit extends gmp_clrbit
{
    public $examples = [
        [
            'number' => "2",
            '$a',
            0
        ],
        [
            'number' => "0xfd",
            '$a',
            1
        ],
        [
            'number' => "0xff",
            '$a',
            0,
            false
        ],
    ];
    public $synopsis = 'void gmp_setbit ( resource &$a , int $index [, bool $bit_on = true ] )';
}
