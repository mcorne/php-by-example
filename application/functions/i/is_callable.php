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

class is_callable extends function_core
{
    public $examples = [
        ["someFunction", false],
        ['is_callable'],
        [
            ['Exception', 'getMessage'],
            true,
            '$callable_name',
        ]
    ];

    public $helper_callbacks = ['function_name_pattern' => '~(cmp$|^ctype_|^gmp|^is_|^str[ifprst])~'];

    public $synopsis = 'bool is_callable ( callable $name [, bool $syntax_only = false [, string &$callable_name ]] )';
}
