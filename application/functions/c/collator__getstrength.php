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

class collator__getstrength extends function_core
{
    public $constant_prefix = ['strength' => 'Collator::'];

    public $examples = [
        [
            'locale'    => 'en_US',
            'strength' => 'Collator::PRIMARY',
        ],
    ];

    public $input_args = ['locale', 'strength'];

    public $source_code = '
        $collator = Collator::create(
            $locale // string $locale
        );

        $bool = $collator->setStrength(
            $strength // int $strength
        );

        inject_function_call

        // displays the strength name
        $name = pbx_get_class_constant_name($int, "Collator", true);
    ';
    public $synopsis = 'public int Collator::getStrength ( void )';

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

        $strength = $this->_filter->filter_arg_value('strength');
        $this->result['bool'] = $this->object->setStrength($strength);
    }
}
