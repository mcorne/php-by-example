<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_ereg_search.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class mb_ereg_search_getpos extends mb_ereg_search
{
    public $examples = [
        [
            'encoding' => 'UTF-8',
            'i_string' => 'Peter is a boy.',
            'i_pattern' => '[ei]',
        ],
    ];

    public $source_code = '
        $mixed = mb_regex_encoding(
            $encoding // [string $encoding]
        );

        $i_bool = mb_ereg_search_init(
            $i_string, // string $i_string
            $i_pattern // string $i_pattern
        );

        $bool = mb_ereg_search();

        inject_function_call
    ';

    public $input_args = ['encoding', 'i_string', 'i_pattern'];

    public $synopsis = 'int mb_ereg_search_getpos ( void )';

    function pre_exec_function()
    {
        parent::pre_exec_function();

        $string = $this->_filter->filter_arg_value('i_string');
        $i_pattern = $this->_filter->filter_arg_value('i_pattern');
        $this->result['i_bool'] = mb_ereg_search_init($string, $i_pattern);
        $this->result['bool'] = mb_ereg_search();
    }
}
