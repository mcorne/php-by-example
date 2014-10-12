<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * test execution
 * all test classes must extend this class
 */

class unit_test_core extends object
{
    const TEST_METHOD_PATTERN = '~_test$~';
    const TEST_METHOD_SUFFIX  = '_test';

    public $excluded_methods = ['__construct'];

    function _get_all_methods_to_test($class_name = null, $directory = null, $fixed_classname = null)
    {
        if (! $class_name) {
            $class_name = $this->tested_class_name;
        }

        if (! $directory) {
            $directory = $this->directory;
        }

        if (! $fixed_classname) {
            $fixed_classname = $class_name;
        }

        $this->load_class($class_name, $directory);
        $methods = $this->get_class_declared_methods($fixed_classname);
        $all_methods_to_test = array_diff($methods, $this->excluded_methods);
        $all_methods_to_test = array_fill_keys($all_methods_to_test, true);

        return $all_methods_to_test;
    }

    function _get_test_class_name()
    {
        $test_class_name = get_class($this);

        return $test_class_name;
    }

    function _get_tested_class_name()
    {
        $tested_class_name = $this->get_tested_item_name($this->test_class_name);

        return $tested_class_name;
    }

    function _get_tested_methods()
    {
        $test_methods = $this->get_class_declared_methods($this->test_class_name, self::TEST_METHOD_PATTERN);
        $tested_methods = [];

        foreach ($test_methods as $test_method_name) {
            $tested_method_name = preg_replace(self::TEST_METHOD_PATTERN, '', $test_method_name);
            $tested_methods[$tested_method_name] = true;
        }

        return $tested_methods;
    }

    function get_class_declared_methods($class_name, $pattern = null)
    {
        $class = new ReflectionClass($class_name);
        $methods = $class->getMethods();
        $declared_methods = [];

        foreach ($methods as $method) {
            if ($method->class == $class_name and (! $pattern or preg_match($pattern, $method->name))) {
                // the method is declared in the class and matches the pattern if any
                $declared_methods[] = $method->name;
            }
        }

        return $declared_methods;
    }

    function get_method_test_success($method_test_results)
    {
        foreach ($method_test_results as $method_test_result) {
            if ($method_test_result['status'] == 'test_failed') {
                return 'test_failed';
            }
        }

        return 'test_success';
    }

    function get_missing_test_methods($methods_test_results)
    {
        $missing_test_methods = array_diff_key($this->all_methods_to_test, $methods_test_results);
        $missing_test_methods = array_fill_keys(array_keys($missing_test_methods), ['status' => 'test_missing']);

        return $missing_test_methods;
    }

    function get_obsolete_test_methods()
    {
        $obsolete_test_methods = array_diff_key($this->tested_methods, $this->all_methods_to_test);
        $obsolete_test_methods = array_fill_keys(array_keys($obsolete_test_methods), ['status' => 'test_obsolete']);

        return $obsolete_test_methods;
    }

    function get_test_item_name($tested_item_name)
    {
        $test_item_name = $tested_item_name . self::TEST_METHOD_SUFFIX;

        return $test_item_name;
    }

    function get_tested_item_name($test_item_name)
    {
        $tested_item_name = preg_replace(self::TEST_METHOD_PATTERN, '', $test_item_name);

        return $tested_item_name;
    }

    function test_class($directory)
    {
        $this->directory = $directory;

        $methods_test_results  = $this->test_methods();
        $missing_test_methods  = $this->get_missing_test_methods($methods_test_results);
        $obsolete_test_methods = $this->get_obsolete_test_methods();

        return [$methods_test_results, $missing_test_methods, $obsolete_test_methods];
    }

    function test_method($params, $expected_return, $expect_exception = false, $expected_properties = null)
    {
        $test_method_name = debug_backtrace()[1]['function'];
        $method_name = $this->get_tested_item_name($test_method_name);

        $object_name = $this->get_object_name($this->tested_class_name);
        $object = $this->create_object($this->tested_class_name, $this->directory);

        $result = [
            'class'    => $this->tested_class_name,
            'expected' => $expected_return,
            'method'   => $method_name,
            'params'   => $params,
        ];

        try {
            $result['returned'] = call_user_func_array([$object, $method_name], $params);
            $success = (! $expect_exception and $result['returned'] === $expected_return);

        } catch (Exception $e) {
            $result['exception'] = ['code' => $e->getCode(), 'message' => $e->getMessage()];
            $success = ($expect_exception and $result['exception'] === $expected_return);
        }

        if ($expected_properties) {
            list($result['properties'], $properties_test_success) = $this->test_properties($expected_properties);
            $success &= $properties_test_success;
        }

        $result['status'] = $success ? 'test_success' : 'test_failed';

        return $result;
    }

    function test_methods()
    {
        $methods_to_test = array_intersect_key($this->all_methods_to_test, $this->tested_methods);
        $methods_test_results = [];

        foreach (array_keys($methods_to_test) as $method_name) {
            $test_method_name = $this->get_test_item_name($method_name);

            if ($method_test_results = $this->$test_method_name()) {
                $methods_test_results[$method_name] = [
                    'results' => $method_test_results,
                    'status'  => $this->get_method_test_success($method_test_results),
                ];
            }
        }

        return $methods_test_results;
    }

    function test_properties($expected_properties)
    {
        $properties_test_success = true;
        $results = [];

        foreach ($expected_properties as $expected_property) {
            list($class_name, $property_name, $expected_value) = $expected_property;

            $object_name = $this->get_object_name($class_name);
            $value = $this->$object_name->$property_name;

            $success = $value === $expected_value;
            $properties_test_success &= $success;

            $result = [
                'class'    => $class_name,
                'expected' => $expected_value,
                'property' => $property_name,
                'status'   => $success ? 'test_success' : 'test_failed',
                'value'    => $value,
            ];

            $results[] = $result;
        }

        return [$results, $properties_test_success];
    }
}
