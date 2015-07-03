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

class collator__setstrength extends function_core
{
    public $constant_prefix = ['strength' => 'Collator::'];

    public $examples = [
        [
            'locale' => 'en_US',
            'Collator::PRIMARY',
        ],
    ];

    public $input_args = ['locale'];

    public $source_code = '
        $collator = Collator::create(
            $locale // string $locale
        );

        inject_function_call

        // shows the strength value and name
        $value = $collator->getStrength();
        $name = pbx_get_class_constant_name($value, "Collator", true);
    ';

    public $synopsis = 'public bool Collator::setStrength ( int $strength )';

    function post_exec_function()
    {
        if (! $this->object) {
            return;
        }

        $this->result['value'] = $this->object->getStrength();
        $this->result['name'] = pbx_get_class_constant_name($this->result['value'], 'Collator', true);
    }

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');
        $this->result['collator'] = $this->object = Collator::create($locale);
    }
}
