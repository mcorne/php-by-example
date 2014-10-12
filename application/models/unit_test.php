<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';
require_once 'function_core.php';
require_once 'unit_test_core.php';

class unit_test extends action
{
    function process()
    {
        list($methods_test_results, $missing_test_methods, $obsolete_test_methods) = $this->test_class();
        $this->class_test_results = $methods_test_results + $missing_test_methods + $obsolete_test_methods;
        ksort($this->class_test_results);
    }

    function test_class($unit_test_name = null)
    {
        if (! $unit_test_name) {
            $unit_test_name = $this->_application->unit_test_name;
        }

        if ($this->_unit_test_list->is_testable_class($unit_test_name)) {
            list($directory, $test_class_name) = $this->_unit_test_list->parse_unit_test_name($unit_test_name);

            if ($this->_unit_test_list->unit_test_exists($unit_test_name)) {
                $this->create_object($test_class_name, "unit-tests/$directory", 'unit_test');

            } else {
                eval("class $test_class_name extends unit_test_core {}");
                $this->create_object($test_class_name, null, 'unit_test');
            }

            $class_test_results = $this->_unit_test->test_class($directory);
        }

        return $class_test_results;
    }
}
