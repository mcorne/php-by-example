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

class collator__compare extends function_core
{
    public $examples = [
        [
            'locale' => 'en_US',
            'Hello',
            'hello',
        ],
    ];

    public $input_args = ['locale'];

    public $source_code = '
        $collator = Collator::create(
            $locale // string $locale
        );

        inject_function_call
    ';

    public $synopsis = 'public int Collator::compare ( string $str1 , string $str2 )';

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');
        $this->object = Collator::create($locale);
    }
}
