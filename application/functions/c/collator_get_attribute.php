<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'collator__getattribute.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class collator_get_attribute extends collator__getattribute
{
    public $manual_function_name = 'Collator::getAttribute';

    public $source_code = '
        $_coll = collator_create(
            $locale // string $locale
        );

        $bool = collator_set_attribute(
            $coll,
            $attribute, // int $attribute
            $value, // int $value
        );

        inject_function_call

        // displays the attribute name
        $name = pbx_get_class_constant_name($int, "Collator", true);
    ';

    public $synopsis = 'int collator_get_attribute ( Collator $coll, int $attr )';

    function init()
    {
        foreach($this->examples as $index => $example) {
            array_splice($example, 1, 0, '$coll');
            $examples[$index] = $example;
        }

        $this->examples = $examples;
    }

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');

        if (! $this->returned_params['coll'] = collator_create($locale)) {
            return;
        }

        $attribute = $this->_filter->filter_arg_value('attribute');
        $value = $this->_filter->filter_arg_value('value');
        $this->result['bool'] = collator_set_attribute($this->returned_params['coll'], $attribute, $value);
    }
}
