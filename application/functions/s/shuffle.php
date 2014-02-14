<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/a/array_pop.php';

class shuffle extends array_pop
{
    public $examples = [
        [
            '__array' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
            '$array',
        ],
    ];

    public $synopsis = 'bool shuffle ( array &$array )';

    public $test_not_validated = true;
}
