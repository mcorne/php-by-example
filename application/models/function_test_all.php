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
        $has_test_success = false;

        foreach ($test_validations as $test_validation) {
            if ($test_validation['status'] == 'test_success') {
                $has_test_success = true;

            } else if ($test_validation['status'] != 'test_not_validated') {
                return $test_validation['status'];
            }
        }

        return $has_test_success ? 'test_success' : 'test_not_validated';
    }

    function count_failed_tests($test_validations)
    {
        $count = 0;

        foreach ($test_validations as $test_validation) {
            if ($test_validation['status'] == 'test_failed') {
                $count++;
            }
        }

        return $count;
    }

    function run()
    {
        $function_list = $this->_function_list->function_list;
        $function_basenames = array_keys($function_list);
        $functions_test_results = array_map([$this->_function_test, 'process'], $function_basenames);
        $functions_test_results = array_combine($function_basenames, $functions_test_results);

        list($this->functions, $this->totals, $this->test_count_by_function, $this->test_failed_counts) =
            $this->summarize_test_results($functions_test_results, $function_list);

        // resets the function name that has been set by the last test for displaying purposes
        $this->_synopsis->function_name = null;

        parent::run();
    }

    function summarize_test_results($functions_test_results, $function_list)
    {
        $test_count_by_function = [];
        $test_failed_counts = [];

        foreach ($functions_test_results as $function_basename => $function_test_results) {
            list($test_validations , $obsolete_expected_results, $is_function_available) = $function_test_results;
            $function_name = $function_list[$function_basename];
            $status = $this->consolidate_test_validations($test_validations);
            $test_count = count($test_validations);
            isset($totals[$status]) or $totals[$status] = 0;

            if ($is_function_available !== true) {
                $functions['not_available'][$function_basename] = $function_name;

            } else if ($status == 'test_failed') {
                $functions['test_failed'][$function_basename] = $function_name;
                $totals['test_failed'] += $test_count;
                $test_failed_counts[$function_basename] = $this->count_failed_tests($test_validations);

            } else if ($status == 'test_missing') {
                $functions['test_missing'][$function_basename] = $function_name;

            } else if ($obsolete_expected_results) {
                $functions['test_obsolete'][$function_basename] = $function_name;

            } else if (! $test_validations) {
                $functions['not_tested'][$function_basename] = $function_name;

            } else if ($status == 'test_success') {
                $functions['test_success'][$function_basename] = $function_name;
                $totals['test_success'] += $test_count;

            } else if ($status == 'test_not_validated') {
                $functions['test_not_validated'][$function_basename] = $function_name;
                $totals['test_not_validated'] += $test_count;

            } else {
                throw new Exception('unexpected test status');
            }

            $test_count_by_function[$function_basename] = $test_count;
        }

        return [$functions, $totals, $test_count_by_function, $test_failed_counts];
    }
}
