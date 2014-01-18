<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class array_rand extends function_core
{
    public $examples = [
        [
            ["Neo", "Morpheus", "Trinity", "Cypher", "Tank"],
            2
        ],
    ];

    public $synopsis = 'mixed array_rand ( array $array [, int $num = 1 ] )';
}