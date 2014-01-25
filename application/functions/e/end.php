<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/a/array_pop.php';

class end extends array_pop
{
    public $examples = [
        [
            '__array' => [
                'apple',
                'banana',
                'cranberry'
            ],
            '$array',
        ],
    ];

    public $synopsis = 'mixed end ( array &$array )';
}
