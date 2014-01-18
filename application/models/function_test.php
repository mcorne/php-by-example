<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';

class function_test extends action
{
    function get_expected_results($function_basename, $test_results)
    {
        $function_sub_directory = $function_basename[0];
        $expected_results_filename = sprintf('%s/data/tests/%s/%s.php', $this->application_path, $function_sub_directory, $function_basename);

        if (! file_exists($expected_results_filename)) {
            // this is the first time the test is run for this function, saves the test results
            // this will be used as a reference to validate subsequent tests
            // note that this first test must be fully validated by the developper
            $this->_file->write_array($expected_results_filename, $test_results);
        }

        $expected_results = $this->_file->read_array($expected_results_filename);

        return $expected_results;
    }

    function process($function_basename = null)
    {
        if (! $function_basename) {
            $function_basename = $this->function_basename;
        }

        $test_results = $this->test_examples($function_basename);
        $expected_results = $this->get_expected_results($function_basename, $test_results);
        $test_validations = $this->validate_test_results($test_results, $expected_results);
        $obsolete_expected_results = count($expected_results) - count($this->examples) > 0;

        return [$test_validations, $obsolete_expected_results];
    }

    function run()
    {
        list($this->test_validations , $this->obsolete_expected_results) = $this->process();
        parent::run();
    }

    function test_example($function_basename, $example_id)
    {
        $function = $this->_function_factory->create_function_object($function_basename);
        $function->test_example_id = $example_id;
        $function->process();

        if($function->result) {
            $test_result['result'] = $function->result;
        }

        if($function->errors) {
            $test_result['errors'] = $function->errors;
        }

        return $test_result;
    }

    function test_examples($function_basename)
    {
        $function = $this->_function_factory->create_function_object($function_basename);
        $this->set_properties($function);

        foreach (array_keys($this->examples) as $example_id) {
            $test_results[] = $this->test_example($function_basename, $example_id);
        }
        return $test_results;
    }

    function validate_test_results($test_results, $expected_results)
    {
        $test_validations = [];

        foreach ($test_results as $example_id => $test_result) {
            $test_validation = ['test_result' => $test_result];

            if (! isset($expected_results[$example_id])){
                $test_validation['status'] = null;

            } else {
                $expected_result = $expected_results[$example_id];

                if ($test_result === $expected_result) {
                    $test_validation['status'] = true;
                } else {
                    $test_validation['status'] = false;
                    $test_validation['expected_result'] = $expected_result;
                }
            }

            $test_validations[$example_id] = $test_validation;
        }

        // note that if there are less test results than expected results, this is ok
        // the obsolete expected results should ideally be removed from the function test file in the "data/tests" directory

        return $test_validations;
    }
}
