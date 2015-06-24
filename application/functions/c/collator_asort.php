<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
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

class collator_asort extends collator__asort
{
    public $manual_function_name = 'Collator::asort';

    public $source_code = '
        $_coll = collator_create(
            $locale // string $locale
        );

        $_arr =
            $__arr; // array $__arr

        inject_function_call
    ';

    public $synopsis = 'bool collator_asort ( Collator $coll, array &$arr [, int $sort_flag ] )';

    function init()
    {
        foreach($this->examples as $index => $example) {
            array_splice($example, 2, 0, '$coll');
            $examples[$index] = $example;
        }

        $this->examples = $examples;
    }

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');
        $this->returned_params['coll'] = collator_create($locale);
    }
}
