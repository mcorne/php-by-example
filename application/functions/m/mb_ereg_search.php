<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'mb_ereg.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class mb_ereg_search extends mb_ereg
{
    public $examples = [
        [
            'encoding' => 'UTF-8',
            'i_string' => 'Peter is a boy.',
            '[i]',
        ],
        [
            'encoding'  => 'UTF-8',
            'i_string'  => 'Peter is a boy.',
            'i_pattern' => '[i]',
        ],
    ];

    public $source_code = '
        $mixed = mb_regex_encoding(
            $encoding // [string $encoding]
        );

        $i_bool = mb_ereg_search_init(
            $i_string, // string $i_string
            $i_pattern // [string $i_pattern]
        );

        inject_function_call
    ';

    public $synopsis = 'bool mb_ereg_search ([ string $pattern [, string $option = &quot;ms&quot; ]] )';
    public $synopsis_fixed = null;

    function pre_exec_function()
    {
        parent::pre_exec_function();

        $string = $this->_filter->filter_arg_value('i_string');

        if ($i_pattern = $this->_filter->filter_arg_value('i_pattern')) {
            $this->result['i_bool'] = mb_ereg_search_init($string, $i_pattern);
        } else {
            $this->result['i_bool'] = mb_ereg_search_init($string);
        }
    }
}
