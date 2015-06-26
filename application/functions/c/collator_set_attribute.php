<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'collator__setattribute.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class collator_set_attribute extends collator__setattribute
{
    public $manual_function_name = 'Collator::setAttribute';

    public $source_code = '
        $_coll = collator_create(
            $locale // string $locale
        );

        inject_function_call

        // shows the attribute value and name
        $value = $collator->getAttribute($attr);
        $name = pbx_get_class_constant_name($value, "Collator", true);
    ';

    public $synopsis = 'bool collator_set_attribute ( Collator $coll, int $attr , int $val )';

    function init()
    {
        foreach($this->examples as $index => $example) {
            array_splice($example, 1, 0, '$coll');
            $examples[$index] = $example;
        }

        $this->examples = $examples;
    }

    function post_exec_function()
    {
        if (! isset($this->returned_params['coll'])) {
            return;
        }

        $attr = $this->_filter->filter_arg_value('attr');
        $this->result['value'] = collator_get_attribute($this->returned_params['coll'], $attr);
        $this->result['name'] = pbx_get_class_constant_name($this->result['value'], 'Collator', true);
    }

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');
        $this->returned_params['coll'] = collator_create($locale);
    }
}
