<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'collator__sort.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class collator__sortwithsortkeys extends collator__sort
{
    public $examples = [
        [
            'locale' => 'sv',
            '__arr'  => [
                'Köpfe',
                'Kypper',
                'Kopfe',
            ],
            '$arr',
        ],
    ];

    public $synopsis = 'public bool Collator::sortWithSortKeys ( array &$arr )';
}
