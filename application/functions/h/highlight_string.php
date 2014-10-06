<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class highlight_string extends function_core
{
    public $examples = [
        ['<?php phpinfo(); ?>', true]
    ];

    public $synopsis = 'mixed highlight_string ( string $str [, bool $return = false ] )';

    public $test_not_validated = true;

    function pre_exec_function()
    {
        $this->_filter->is_allowed_arg_value('return', true, false);
    }
}
