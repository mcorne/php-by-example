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
 * @see docs/function-configuration.txt
 */

class pdo__getattribute extends function_core
{
    public $constant_prefix = [
        '__attribute' => 'PDO::ATTR',
        'attribute'   => 'PDO::ATTR',
        'value'       => 'PDO::',
    ];

    public $examples = [
        [
            '__attribute' => 'PDO::ATTR_CASE',
            'value'       => 'PDO::CASE_LOWER',
            'PDO::ATTR_CASE',
        ],
        [
            'PDO::ATTR_SERVER_VERSION',
        ],
    ];

    public $input_args = ['__attribute', 'attribute', 'value'];

    public $synopsis = 'public mixed PDO::getAttribute ( int $attribute )';

    public $source_code = '
        $pdo = new PDO("sqlite::memory:", null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $bool = $pdo->setAttribute(
            $__attribute, // int $__attribute,
            $value, // mixed $value
        );

        inject_function_call

        // note that setAttribute() is skipped if no param is passed in this example
    ';

    public $test_not_validated = [1];

    function pre_exec_function()
    {
        $this->object = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $attribute = $this->_filter->filter_arg_value('__attribute');
        $value = $this->_filter->filter_arg_value('value');

        if (is_null($attribute) and is_null($value)) {
            return;
        }

        if (defined($value)) {
            $value = constant($value);
        }

        $this->result['bool'] = $this->object->setAttribute($attribute, $value);
    }
}
