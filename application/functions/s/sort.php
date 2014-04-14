<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/a/array_pop.php';

class sort extends array_pop
{
    public $examples = [
        [
            '__array' => [
                "lemon",
                "orange",
                "banana",
                "apple",
            ],
            '$array',
        ],
        [
            '__array' => [
                "Orange1",
                "orange2",
                "Orange3",
                "orange20",
            ],
            '$array',
            'SORT_NATURAL | SORT_FLAG_CASE',
        ],
        // used in translations_in_action.php
        [
            '__array' => [
                "lemon",
            ],
            [123],
        ],
    ];

    public $synopsis = 'bool sort ( array &$array [, int $sort_flags = SORT_REGULAR ] )';
}
