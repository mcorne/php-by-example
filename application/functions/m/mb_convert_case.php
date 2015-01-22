<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
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

class mb_convert_case extends function_core
{
    public $constant_prefix = ['mode' => 'MB_CASE'];

    public $examples = [
        ["mary had a Little lamb and she loved it so", 'MB_CASE_UPPER'],
        ["mary had a Little lamb and she loved it so", 'MB_CASE_TITLE', "UTF-8"],
        ["Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός", 'MB_CASE_UPPER', "UTF-8"],
        ["Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός", 'MB_CASE_TITLE', "UTF-8"]
    ];

    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $source_code = '
        mb_internal_encoding("UTF-8");

        inject_function_call

        // enter non ASCII characters in hex in $_str if $_encoding is not UTF-8
        // the result $_string may not display properly if $_encoding is not UTF-8
    ';

    public $synopsis = 'string mb_convert_case ( string $str , int $mode [, string $encoding = mb_internal_encoding() ] )';

    function post_exec_function()
    {
        // restores the original encoding so it does not affect the result of the overall function test
        mb_internal_encoding($this->mb_internal_encoding);
    }

    function pre_exec_function()
    {
        $this->mb_internal_encoding = mb_internal_encoding();
        mb_internal_encoding('UTF-8');
    }
}
