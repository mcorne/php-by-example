<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// changes to this class may affect other classes

class call_user_func extends function_core
{
    public $examples = [
        [
            'barber',
            "mushroom"
        ],
        [
            '$barber',
            "shave"
        ],
        [
            ['myclass', 'say_hello'],
        ],
        [
            'myclass::say_hello',
        ],
        [
            ['$object', 'say_goodbye'],
            'Bob'
        ],
        [
            'foobar',
            "one",
            "two",
        ],
        [
            'strncmp',
            "abc",
            "DEF",
            3
        ],
        [
            '$xyz',
            "mushroom"
        ],
        [
            ['xyz', 'say_hello'],
        ],
        [
            ['Closure', 'bind'],
        ],
        [
            'myclass::xyz',
        ],
        [
            ['$xyz', 'say_goodbye'],
            'Bob'
        ],
        [
            ['$xyz'],
            'Bob'
        ],
        [
            ['$object', 'say_goodbye'],
        ],
        [
            '$xyz',
            "one",
            "two",
        ],
        [
            'xyz',
            "abc",
            "DEF",
            3
        ],
    ];

    public $helper_callbacks = ['index_in_example' => 0, 'function_name_pattern' => '~(cmp$|^ctype_|^is_|^str[ifprst])~'];

    public $source_code = '
        _DOUBLE_SLASH_ function barber($type)       { return "You wanted a $type haircut, no problem"; };
        _DOUBLE_SLASH_ function foobar($arg, $arg2) { return __FUNCTION__ . " got $arg and $arg2"; };

        // adds custom callback functions, closures and methods
        require "pbx_callbacks.php";
        class_alias("pbx_callbacks", "myclass");
        $object = new myclass();

        inject_function_call
    ';

    public $synopsis       = 'mixed call_user_func ( callable $callback [, mixed $parameter [, mixed $... ]] )';
    public $synopsis_fixed = 'mixed call_user_func ( callable $callback [, mixed $parameter1 [, mixed $parameter2 [, mixed $parameter3 [, mixed $... ]]]] )';

    function pre_exec_function()
    {
        $this->_filter->filter_callback('callback', 'myclass');
    }
}
