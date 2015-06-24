<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'collator__asort.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class collator__sort extends collator__asort
{
    public $examples = [
        [
            'locale' => 'en_US',
            '__arr'  => [
                'at',
                'às',
                'as',
            ],
            '$arr',
        ],
    ];

    public $synopsis = 'public bool Collator::sort ( array &$arr [, int $sort_flag ] )';
}
