<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/p/print_r.php';

class var_export extends print_r
{
    public $examples = [
        [
            [
                0 => 1,
                1 => 2,
                2 => [
                    0 => "a",
                    1 => "b",
                    2 => "c",
                ],
            ],
            true
        ],
        [
            3.1,
            true
        ]
    ];

    public $synopsis = 'mixed var_export ( mixed $expression [, bool $return = false ] )';
}
