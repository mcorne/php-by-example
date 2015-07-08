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

class collator__getsortkey extends function_core
{
    public $examples = [
        [
            'locale' => 'en_US',
            'Hello',
        ],
    ];

    public $source_code = '
        $collator = Collator::create(
            $locale // string $locale
        );

        inject_function_call

        // shows the result in hexadecimal
        $hex = bin2hex($string);
    ';

    public $synopsis = 'public string Collator::getSortKey ( string $str )';

    public $test_not_validated = true;

    function post_exec_function()
    {
        $this->result['hex'] = bin2hex($this->result['string']);
    }

    function pre_exec_function()
    {
        $locale = $this->_filter->filter_arg_value('locale');
        $this->result['collator'] = $this->object = Collator::create($locale);
    }
}
