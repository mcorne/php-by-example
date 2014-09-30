<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class class_alias extends function_core
{
    public $examples = [
        [
            "action",
            "baz"
        ],
        [
            "Exception",
            "baz"
        ],
        [
            "xyz",
            "baz"
        ]
    ];

    public $options_getter = ['original' => 'get_declared_classes'];

    public $source_code = '
        inject_function_call

        // shows the properties and methods of the original and alias classes
        // note that $original and $alias below actually represent arguments
        if ($_bool) {
            $original_class = [
                "properties" => array_keys(get_class_vars($original)),
                "methods"    => get_class_methods($original),
            ];
            $alias_class = [
                "properties" => array_keys(get_class_vars($alias)),
                "methods"    => get_class_methods($alias),
            ];
        }
    ';

    public $synopsis = 'bool class_alias ( string $original , string $alias [, bool $autoload = TRUE ] )';

    function post_exec_function()
    {
        if ($this->result['bool']) {
            $original = $this->_filter->filter_arg_value('original');
            $this->result['original_class'] = [
                'properties' => array_keys(get_class_vars($original)),
                'methods'    => get_class_methods($original),
            ];

            $alias = $this->_filter->filter_arg_value('alias');
            $this->result['alias_class'] = [
                'properties' => array_keys(get_class_vars($alias)),
                'methods'    => get_class_methods($alias),
            ];
        }
    }
}
