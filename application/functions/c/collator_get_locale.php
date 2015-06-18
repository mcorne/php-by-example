<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'collator__getlocale.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class collator_get_locale extends collator__getlocale
{
    public $manual_function_name = 'Collator::getLocale';

    public $source_code = '
        $_coll = collator_create(
            $locale // string $locale
        );

        inject_function_call
    ';

    public $synopsis = 'public string collator_get_locale ( Collator $coll, int $type )';

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
        $this->returned_params['coll'] = collator_create($locale);
    }
}
