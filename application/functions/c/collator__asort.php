<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class collator__asort extends function_core
{
    public $constant_prefix = [
        'sort_flag' => 'Collator::SORT',
    ];

    public $examples = [
        [
            'locale' => 'en_US',
            '__arr'  => [
                'a' => '100',
                'b' => '50',
                'c' => '7',
            ],
            '$arr',
            'Collator::SORT_NUMERIC',
        ],
        [
            'locale' => 'en_US',
            '__arr'  => [
                'a' => '100',
                'b' => '50',
                'c' => '7',
            ],
            '$arr',
            'Collator::SORT_STRING',
        ],
    ];

    public $input_args = ['locale', '__arr'];

    public $source_code = '
        $collator = Collator::create(
            $locale // string $locale
        );

        $_arr =
            $__arr; // array $__arr

        inject_function_call
    ';

    public $synopsis = 'public bool Collator::asort ( array &$arr [, int $sort_flag ] )';

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');
        $this->object = Collator::create($locale);
    }
}
