<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class filter_test extends unit_test_core
{
    function filter_arg_value_test()
    {
        $this->create_object('function_core', null, "function");

        $this->_function_params->params = ['foo' => 123];
        $results['arg-ok'] = $this->test_method(['foo'], 123);
        $results['no-arg'] = $this->test_method(['xyz'], null);

        $this->_function_params->params   = ['foo' => '$bar'];
        $this->_function->returned_params = ['bar' => 456];
        $results['var'] = $this->test_method(['foo'], 456);

        return $results;
    }

    function filter_closure_callback_test()
    {
        $this->create_object('function_core', null, "function");
        $expected_properties = [ ['function', 'returned_params', ['barber' => $GLOBALS['barber']]] ];
        $results['closure-ok'] = $this->test_method(['$barber'], $GLOBALS['barber'], null, $expected_properties);

        $this->create_object('function_core', null, "function");
        $expected_properties = [ ['function', 'returned_params', []] ];
        $results['no-closure'] = $this->test_method(['$xyz'], null, false, $expected_properties);

        return $results;
    }

    function is_custom_callback_function_test()
    {
        $results['callback-ok'] = $this->test_method(['barber'], true);
        $results['no-callback'] = $this->test_method(['xyz']   , false);

        return $results;
    }
}
