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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class constant extends function_core
{
    public $constant_as_string = ['name' => true];

    public $examples = ["MAXSIZE", "bar::test", "foo::test", "E_ALL", "TEST"];

    public $source_code = '
        // defines constants
        define("MAXSIZE", 100);
        interface bar { const test = "foobar!"; }
        class     foo { const test = "foobar!"; }

        inject_function_call
    ';

    public $synopsis = 'mixed constant ( string $name )';

    function _get_options_list()
    {
        $constants = get_defined_constants();
        $options_list = ['name' => array_keys($constants)];

        return $options_list;
    }

    function pre_exec_function()
    {
        if (! defined("MAXSIZE")) {
            define("MAXSIZE", 100);
        }

        if (! interface_exists('bar')) {
            eval('interface bar { const test = "foobar!"; }');
        }

        if (! class_exists('foo')) {
            eval('class     foo { const test = "foobar!"; }');
        }
    }
}
