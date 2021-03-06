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

 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class collator__geterrorcode extends function_core
{
    public $constant_prefix = [
        'attribute' => 'Collator::',
    ];

    public $examples = [
        [
            'locale'    => 'en_US',
            'attribute' => 99,
        ],
    ];

    public $input_args = ['attribute', 'locale'];

    public $synopsis = 'public int Collator::getErrorCode ( void )';

    public $source_code = '
        $collator = Collator::create(
            $locale // string $locale
        );

        $bool = $collator->getAttribute(
            $attribute // int $attribute
        );

        inject_function_call
    ';

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');

        if (! $this->result['collator'] = $this->object = Collator::create($locale)) {
            return;
        }

        $attribute = $this->_filter->filter_arg_value('attribute');
        $this->result['bool'] = $this->object->getAttribute($attribute);
    }
}
