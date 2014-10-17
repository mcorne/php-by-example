<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';

class unit_test_all extends action
{
    function count_status_methods_test_results($methods_test_results, $status)
    {
        $status_count = 0;

        foreach ($methods_test_results as $method_test_results) {
            foreach ($method_test_results['results'] as $method_test_result) {
                $status_count += $method_test_result['status'] == $status;
            }
        }

        return $status_count;
    }

    function get_class_test_success($methods_test_results)
    {
        foreach ($methods_test_results as $method_test_results) {
            if ($method_test_results['status'] == 'test_failed') {
                return 'test_failed';
            }
        }

        return 'test_success';
    }

    function process()
    {
        $unit_test_names = array_keys($this->_unit_test_list->unit_test_list);

        $this->classes_not_tested = array_diff_key($this->_unit_test_list->testable_class_list, $this->_unit_test_list->unit_test_list);

        $this->methods_counts = [];
        $this->test_counts = [];
        $this->test_failed_counts = [];
        $this->test_missing_counts = [];
        $this->test_obsolete_counts = [];
        $this->test_success_counts = [];

        foreach ($unit_test_names as $unit_test_name) {
            list($methods_test_results, $missing_test_methods, $obsolete_test_methods) = $this->_unit_test->test_class($unit_test_name);

            if ($methods_test_results) {
                $status = $this->get_class_test_success($methods_test_results);

                // counts all tests in each tested method
                if ($status == 'test_failed') {
                    $test_success_count = $this->count_status_methods_test_results($methods_test_results, 'test_success');
                    $test_failed_count  = $this->count_status_methods_test_results($methods_test_results, 'test_failed');
                    $test_count = $test_success_count + $test_failed_count;

                    $this->test_counts[$unit_test_name] = $test_count;
                    $this->test_failed_counts[$unit_test_name] = $test_failed_count;

                } else {
                    $this->test_success_counts[$unit_test_name] = $this->count_status_methods_test_results($methods_test_results, 'test_success');
                }
            }

            if ($missing_test_methods) {
                $missing_test_methods_count = count($missing_test_methods);
                $methods_count = count($methods_test_results) + $missing_test_methods_count;

                $this->test_missing_counts[$unit_test_name] = $missing_test_methods_count;
                $this->methods_counts[$unit_test_name] = $methods_count;
            }

            if ($obsolete_test_methods) {
                $this->test_obsolete_counts[$unit_test_name] = count($obsolete_test_methods);
            }
        }
    }
}
