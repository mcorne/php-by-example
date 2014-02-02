<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class is_callable extends function_core
{
    public $examples = [
        ["someFunction", false],
        ['is_callable']
    ];

    public $helper_callbacks = ['function_name_pattern' => '~(cmp$|^ctype_|^gmp|^is_|^str[ifprst])~'];

    public $synopsis = 'bool is_callable ( callable $name [, bool $syntax_only = false [, string &$callable_name ]] )';
}
