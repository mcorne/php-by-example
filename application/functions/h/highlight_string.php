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
