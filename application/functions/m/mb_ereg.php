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

class mb_ereg extends function_core
{
    public $examples = [
        [
            'encoding' => 'UTF-8',
            'is',
            'Peter is a boy.'
        ],
        [
            'encoding' => 'UTF-8',
            'is',
            'Peter is a boy.',
            '$regs',
        ],
        [
            'encoding' => 'UTF-8',
            '([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',
            '2015-02-13',
            '$regs',
        ],
        [
            'encoding' => 'UTF-8',
            'xyz',
            'Peter is a boy.'
        ],
    ];

    public $input_args = ['encoding'];

    public $options_getter = ['encoding' => 'mb_list_encodings'];

    public $source_code = '
        $mixed = mb_regex_encoding(
            $encoding // [string $encoding]
        );

        inject_function_call
    ';

    public $synopsis       = 'int mb_ereg ( string $pattern , string $string [, array $regs ] )';
    public $synopsis_fixed = 'int mb_ereg ( string $pattern , string $string [, array &$regs ] )';

    function pre_exec_function()
    {
        $encoding = $this->_filter->filter_arg_value('encoding');
        $this->result['mixed'] = mb_regex_encoding($encoding);
    }
}
