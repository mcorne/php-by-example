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

class collator__getattribute extends function_core
{
    public $constant_prefix = [
        'attr'      => 'Collator::',
        'attribute' => 'Collator::',
        'value'     => 'Collator::',
    ];

    public $examples = [
        [
            'locale'    => 'en_US',
            'attribute' => 'Collator::NUMERIC_COLLATION',
            'value'     => 'Collator::ON',
            'Collator::NUMERIC_COLLATION'
        ],
    ];

    public $input_args = ['attr', 'attribute', 'locale', 'value'];

    public $source_code = '
        $collator = Collator::create(
            $locale // string $locale
        );

        $bool = $collator->setAttribute(
            $attribute, // int $attribute
            $value, // int $value
        );

        inject_function_call

        // displays the attribute name
        $name = pbx_get_class_constant_name($int, "Collator", true);
    ';

    public $synopsis = 'public int Collator::getAttribute ( int $attr )';

    function post_exec_function()
    {
        if (isset($this->result['int'])) {
            $this->result['name'] = pbx_get_class_constant_name($this->result['int'], 'Collator', true);
        }
    }

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');

        if (! $this->result['collator'] = $this->object = Collator::create($locale)) {
            return;
        }

        $attribute = $this->_filter->filter_arg_value('attribute');
        $value = $this->_filter->filter_arg_value('value');
        $this->result['bool'] = $this->object->setAttribute($attribute, $value);
    }
}
