<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'custom/pbx_get_classes_defined_constants.php';
require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class collator__setattribute extends function_core
{
    public $constant_prefix = [
        'attr' => 'Collator::',
        'val'  => 'Collator::',
    ];

    public $examples = [
        [
            'locale' => 'en_US',
            'Collator::NUMERIC_COLLATION',
            'Collator::ON',
        ],
    ];

    public $input_args = ['locale'];

    public $source_code = '
        $collator = Collator::create(
            $locale // string $locale
        );

        inject_function_call

        // shows the attribute value and name
        $value = $collator->getAttribute($attr);
        $name = pbx_get_class_constant_name($value, "Collator", true);
    ';

    public $synopsis = 'public bool Collator::setAttribute ( int $attr , int $val )';

    function post_exec_function()
    {
        if (! $this->object) {
            return;
        }

        $attr = $this->_filter->filter_arg_value('attr');
        $this->result['value'] = $this->object->getAttribute($attr);
        $this->result['name'] = pbx_get_class_constant_name($this->result['value'], 'Collator', true);
    }

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');
        $this->object = Collator::create($locale);
    }
}
