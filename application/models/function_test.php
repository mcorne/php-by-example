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
            $directory = dirname($expected_results_filename);

            if (! is_dir($directory)) {
                $this->_file->create_directory($directory);
            }

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
            $test_result['result'] = $this->_converter->convert_resource_to_text($function->result);
        }

        if($function->errors) {
            $test_result['errors'] = $function->errors;
        }

        return $test_result;
    }

    function test_examples($function_basename)
    {
        // resets the some inherited properties
        // eg the synopsis, so the actual function synopsis will be fetched if needed
        // note that it would have been set by the first function that needed it, eg "acos",
        // and inherited as such when the test is run through test_all
        unset($this->_synopsis, $this->test_always_valid);

        $language_id = $this->_language->language_id;
        $this->_language->language_id = 'en';

        // forces the test to run in english so returned messages are always compared in english
        $function = $this->_function_factory->create_function_object($function_basename);
        $this->set_properties($function);
        $test_results = [];

        foreach (array_keys($this->examples) as $example_id) {
            $example = print_r($this->examples[$example_id], true);

            if (! strpos($example, 'www.example.com')) {
                $test_results[$example_id] = $this->test_example($function_basename, $example_id);
            }
        }

        // restores the user language
        $this->_language->language_id = $language_id;

        return $test_results;
    }

    function validate_test_result($test_result, $expected_result, $example_id)
    {
        if ($this->test_always_valid === true or in_array($example_id, (array) $this->test_always_valid)) {
            // the test is considered always valid for this function, eg random generators, list of functions or constants etc.
            $test_validation['status'] = true;

        } else if ($test_result === $expected_result) {
            $test_validation['status'] = true;

        } else  {
            $test_value = current($test_result['result']);
            $expected_value = current($expected_result['result']);

            if (is_float($test_value) and
                (is_int($expected_value) or is_float($expected_value)) and
                (is_nan($test_value) and is_nan($expected_value) or abs($test_value - $expected_value) < 0.00001))
            {
                // the test value is a float and the expected value is an integer or a float, they are equal with a precision of 5 digits
                // note that an expected value being store as eg "123" is interpreted as an integer by PHP
                // note that float numbers might note be strickly equal due to floating precision limitation
                $test_validation['status'] = true;

            } else {
                $test_validation['status'] = false;
                $test_validation['expected_result'] = $expected_result;
            }
        }

        return $test_validation;
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
                $test_validation += $this->validate_test_result($test_result, $expected_result, $example_id);
            }

            $test_validations[$example_id] = $test_validation;
        }

        // note that if there are less test results than expected results, this is ok
        // the obsolete expected results should ideally be removed from the function test file in the "data/tests" directory

        return $test_validations;
    }
}
