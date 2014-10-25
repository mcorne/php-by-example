<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * returns the list of unit tests
 */

class unit_test_list extends object
{
    function _get_testable_class_list()
    {
        $filenames = array_merge(
            glob("{$this->application_path}/custom/*.php"),
            glob("{$this->application_path}/functions/*/*.php"),
            glob("{$this->application_path}/models/*.php")
        );

        $testable_class_list = [];

        foreach ($filenames as $filename) {
            $path_class_name = str_replace(["{$this->application_path}/", '.php'], '', $filename);
            list($directory, $class_name) = $this->parse_path_class_name($path_class_name);

            $fixed_classname = isset($this->_function_factory->fixed_classnames[$class_name]) ? $this->_function_factory->fixed_classnames[$class_name] : null;

            if ($methods_to_test = $this->_unit_test_core->_get_all_methods_to_test($class_name, $directory, $fixed_classname)) {
                $testable_class_list[$path_class_name] = count($methods_to_test);
            }
        }

        return $testable_class_list;
    }

    function _get_unit_test_list()
    {
        $unit_tests_directory = $this->application_path . '/unit-tests';

        $filenames = array_merge(
            glob("$unit_tests_directory/custom/*.php"),
            glob("$unit_tests_directory/functions/*/*.php"),
            glob("$unit_tests_directory/models/*.php")
        );

        $unit_test_list = [];

        foreach ($filenames as $filename) {
            $unit_test_name = str_replace(["$unit_tests_directory/", '_test.php'], '', $filename);
            $unit_test_list[$unit_test_name] = true;
        }

        return $unit_test_list;
    }

    function get_custom_function_unit_test_name($custom_function_name)
    {
        $unit_test_name = sprintf('custom/%s', $custom_function_name);

        return $unit_test_name;
    }

    function get_function_name($unit_test_name)
    {
        $function_name= null;
        $custom_function_name = null;

        if (preg_match('~^functions/[a-z]/(.+)$~', $unit_test_name, $match)) {
            $function_name = $this->_function_list->get_function_name($match[1]);

        } else if (preg_match('~^custom/(pbx_.+)$~', $unit_test_name, $match)) {
            if ($this->_custom_function->custom_function_exists($match[1])) {
                $custom_function_name = $match[1];
            }
        }

        return [$function_name, $custom_function_name];
    }

    function get_function_unit_test_name($function_basename)
    {
        $function_sub_directory = $function_basename[0];
        $unit_test_name = sprintf('functions/%s/%s', $function_sub_directory, $function_basename);

        return $unit_test_name;
    }

    function is_testable_class($unit_test_name)
    {
        $is_testable_class = isset($this->testable_class_list[$unit_test_name]);

        return $is_testable_class;
    }

    function parse_path_class_name($path_class_name)
    {
        $pieces = explode('/', $path_class_name);
        $class_name = array_pop($pieces);
        $directory = implode('/', $pieces);

        return [$directory, $class_name];
    }

    function parse_unit_test_name($unit_test_name)
    {
        list($directory, $class_name) = $this->parse_path_class_name($unit_test_name);
        $test_class_name = $this->_unit_test_core->get_test_item_name($class_name);

        return [$directory, $test_class_name];
    }

    function unit_test_exists($unit_test_name)
    {
        $unit_test_exists = isset($this->unit_test_list[$unit_test_name]);

        return $unit_test_exists;
    }
}
