<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'collator_asort.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class collator_sort extends collator_asort
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

    public $manual_function_name = 'Collator::sort';

    public $synopsis = 'bool collator_sort ( Collator $coll, array &$arr [, int $sort_flag ] )';
}
