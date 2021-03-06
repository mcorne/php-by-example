<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/a/array_pop.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

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
