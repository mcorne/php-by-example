<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class filter_has_var extends function_core
{
    public $constant_prefix = ['type' => 'INPUT'];

    public $examples = [
        [
            "INPUT_COOKIE",
            'test_cookie',
        ],
        [
            "INPUT_POST",
            'xyz',
        ],
    ];

    public $source_code = '
        setcookie("test_cookie", 123, null, "/");

        inject_function_call
    ';

    public $synopsis = 'bool filter_has_var ( int $type , string $variable_name )';

    public $test_not_validated = 0;

    function _get_options_list()
    {
        $variable_names = array_keys($_GET + $_POST + $_COOKIE + $_SERVER);
        sort($variable_names);
        $options_list = ['variable_name' => $variable_names];

        return $options_list;
    }

    function init()
    {
        setcookie('test_cookie', 123, null, '/');
    }
}
