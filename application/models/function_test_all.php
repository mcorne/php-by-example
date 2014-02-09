<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';

/**
 * all functions test
 * entry points: run()
 */

class function_test_all extends action
{
    function consolidate_test_validations($test_validations)
    {
        foreach ($test_validations as $test_validation) {
            if ($test_validation['status'] !== true) {
                return $test_validation['status'];
            }
        }

        return true;
    }

    function run()
    {
        $function_list = $this->_function_list->function_list;
        $function_basenames = array_keys($function_list);

        $functions_test_results = array_map([$this->_function_test, 'process'], $function_basenames);
        $functions_test_results = array_combine($function_basenames, $functions_test_results);

        $this->test_results = $this->summarize_test_results($functions_test_results, $function_list);

        parent::run();
    }

    function summarize_test_results($functions_test_results, $function_list)
    {
        foreach ($functions_test_results as $function_basename => $function_test_results) {
            list($test_validations , $obsolete_expected_results, $is_function_available) = $function_test_results;
            $function_name = $function_list[$function_basename];
            $status = $this->consolidate_test_validations($test_validations);

            if ($is_function_available !== true) {
                $test_results['functions_not_available'][$function_basename] = $function_name;

            } else if ($status === false) {
                $test_results['functions_with_failed_tests'][$function_basename] = $function_name;

            } else if ($status === null) {
                $test_results['functions_with_missing_tests'][$function_basename] = $function_name;

            } else if ($obsolete_expected_results) {
                $test_results['functions_with_obsolete_tests'][$function_basename] = $function_name;

            } else if (! $test_validations) {
                $test_results['functions_not_tested'][$function_basename] = $function_name;

            } else if ($status === true) {
                $test_results['functions_tested_succesfully'][$function_basename] = $function_name;
            }
        }

        return $test_results;
    }
}
