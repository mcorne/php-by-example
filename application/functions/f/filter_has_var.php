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
            'search_method',
        ],
        [
            "INPUT_POST",
            'xyz',
        ],
    ];

    function _get_options_list()
    {
        $variable_names = array_keys($_GET + $_POST + $_COOKIE + $_SERVER);
        $options_list = ['variable_name' => $variable_names];

        return $options_list;
    }

    public $synopsis = 'bool filter_has_var ( int $type , string $variable_name )';
}
