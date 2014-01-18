<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';

class function_test_all extends action
{
    function run()
    {
        $function_list = $this->_function_list->get_function_list();
        $function_basenames = array_keys($function_list);

        $functions_test_results = array_map([$this->_function_test, 'process'], $function_basenames);
        $functions_test_results = array_combine($function_basenames, $functions_test_results);

        $this->test_results = $this->summarize_test_results($functions_test_results, $function_list);

        parent::run();
    }

    function summarize_test_results($functions_test_results, $function_list)
    {
        $test_success_functions = [];
        $test_failed_functions = [];
        $test_missing_functions = [];
        $test_obsolete_functions = [];

        foreach ($functions_test_results as $function_basename => $function_test_results) {
            list($test_validations , $obsolete_expected_results) = $function_test_results;

            foreach ($test_validations as $test_validation) {
                $status = $test_validation['status'];
                $function_name = $function_list[$function_basename];

                if ($status === true) {
                    $test_success_functions[$function_basename] = $function_name;
                } else if ($status === false) {
                    $test_failed_functions[$function_basename] = $function_name;
                } else {
                    $test_missing_functions[$function_basename] = $function_name;
                }
            }

            if (isset($test_failed_functions[$function_basename])) {
                unset($test_success_functions[$function_basename]);
            }

            if ($obsolete_expected_results) {
                $test_obsolete_functions[$function_basename] = $function_name;
            }
        }

        $test_results = [
            'test_success'  => $test_success_functions,
            'test_failed'   => $test_failed_functions,
            'test_missing'  => $test_missing_functions,
            'test_obsolete' => $test_obsolete_functions,
        ];

        return $test_results;
    }
}
