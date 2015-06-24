<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'collator_sort.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class collator_sort_with_sort_keys extends collator_sort
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

    public $manual_function_name = 'Collator::sortWithSortKeys';

    public $synopsis = 'public bool collator_sort_with_sort_keys ( Collator $coll, array &$arr )';
}
