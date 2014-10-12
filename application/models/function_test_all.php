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
 */

class function_test_all extends action
{
    function compute_test_results($functions_test_results)
    {
        $this->function_names = [];
        $this->test_counts = [];
        $this->test_failed_counts = [];
        $this->test_missing_counts = [];
        $this->test_not_validated_counts = [];
        $this->test_obsolete_counts = [];
        $this->test_success_counts = [];

        foreach ($functions_test_results as $function_basename => $function_test_results) {
            list($test_validations , $test_obsolete_count, $is_function_available) = $function_test_results;
            $function_name = $this->_function_list->function_list[$function_basename];

            if ($is_function_available !== true) {
                $this->function_names['not_available'][$function_basename] = $function_name;
                continue;
            }

            if (! $test_validations) {
                $this->function_names['not_tested'][$function_basename] = $function_name;
            }

            if ($test_obsolete_count) {
                $this->function_names['test_obsolete'][$function_basename] = $function_name;
                $this->test_obsolete_counts[$function_basename] = $test_obsolete_count;
            }

            $status_counts = $this->count_test_status($test_validations);

            if ($status_counts['test_success'] and ! $status_counts['test_failed']) {
                $this->function_names['test_success'][$function_basename] = $function_name;
                $this->test_success_counts[$function_basename] = $status_counts['test_success'];

            } else if ($status_counts['test_failed']) {
                $this->function_names['test_failed'][$function_basename] = $function_name;
                $this->test_failed_counts[$function_basename] = $status_counts['test_failed'];
                $this->test_counts[$function_basename] = $status_counts['test_success'] + $status_counts['test_failed'];
            }

            if ($status_counts['test_missing']) {
                $this->function_names['test_missing'][$function_basename] = $function_name;
                $this->test_missing_counts[$function_basename] = $status_counts['test_missing'];
            }

            if ($status_counts['test_not_validated']) {
                $this->function_names['test_not_validated'][$function_basename] = $function_name;
                $this->test_not_validated_counts[$function_basename] = $status_counts['test_not_validated'];
            }
        }
    }

    function count_test_status($test_validations)
    {
        $status_counts = array_fill_keys(['test_failed', 'test_missing', 'test_not_validated', 'test_success'], 0);

        foreach ($test_validations as $test_validation) {
            $status = $test_validation['status'];
            $status_counts[$status]++;
        }

        return $status_counts;
    }

    function process()
    {
        $function_basenames = array_keys($this->_function_list->function_list);
        $functions_test_results = array_map([$this->_function_test, 'process'], $function_basenames);
        $functions_test_results = array_combine($function_basenames, $functions_test_results);
        $this->compute_test_results($functions_test_results);

        // resets the function name that has been set by the last test for displaying purposes
        $this->_synopsis->function_name = null;
    }
}
