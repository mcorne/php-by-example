<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/a/array_pop.php';

class each extends array_pop
{
    public $examples = [
        [
            '__array' => [
                0 => 'bob',
                1 => 'fred',
                2 => 'jussi',
                3 => 'jouni',
                4 => 'egon',
                5 => 'marliese',
            ],
            '$array',
        ],
        [
            '__array' => [
                'Robert' => 'Bob',
                'Seppo' => 'Sepi',
            ],
            '$array',
        ]
    ];

    public $synopsis       = 'array each ( array &$array )';
    public $synopsis_fixed = 'mixed each ( array &$array )';
}
