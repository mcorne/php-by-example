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
 * function test, all the function examples are tested
 * entry points: run(), process()
 *
 * note that the function test result is saved automatically the first time in the "data/tests" directory, see get_expected_results()
 * the first test result is used as a reference (the expected test result) to validate subsequent test runs
 * the expected test result may have to be replaced if the examples have changed in the function config,
 * it will have to be removed manually from the "data/tests" directory before it can be saved again as explained above
 */

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

            $this->_file->write_array($expected_results_filename, $test_results, ['stdClass::__set_state' => '(object)']);
        }

        $expected_results = $this->_file->read_array($expected_results_filename);

        return $expected_results;
    }

    function object_export($object)
    {
        $exported = var_export($object, true);
        // converts numeric key from string to int, eg '123' to 123
        // note that var_export() exports some numeric keys as string that are implicitely converted to int when the exported object is loaded
        $exported = preg_replace("~'(\d+)' =>~", '$1 =>', $exported);

        return $exported;
    }

    function process($function_basename = null)
    {
        if (! $function_basename) {
            $function_basename = $this->_application->function_basename;
        }

        list($test_results, $this->is_function_available) = $this->test_examples($function_basename);
        $expected_results = $this->get_expected_results($function_basename, $test_results);
        $this->test_validations = $this->validate_test_results($test_results, $expected_results);
        $this->obsolete_expected_results = count($expected_results) - count($this->_function->examples) > 0;

        return [$this->test_validations, $this->obsolete_expected_results, $this->is_function_available];
    }

    function test_example($example_id, $function_basename)
    {
        $this->_function_factory->create_function_object($function_basename);
        // sets the function params to the given example
        $this->_function_params->test_example_id = $example_id;

        $this->_function->process();

        if($this->_function->result) {
            $test_result['result'] = $this->_converter->convert_resource_to_text($this->_function->result);
        }

        if($this->_function->errors) {
            $test_result['errors'] = $this->_function->errors;
        }

        return $test_result;
    }

    function test_examples($function_basename)
    {
        // forces the test to run in english so the returned messages are always validated in English
        $language_id = $this->_language->language_id;
        $this->_language->language_id = 'en';

        $this->_function_factory->create_function_object($function_basename);
        $test_results = [];

        foreach (array_keys($this->_function->examples) as $example_id) {
            if (! ($this->_function->test_not_to_run === true or in_array($example_id, (array) $this->_function->test_not_to_run))) {
                $test_results[$example_id] = $this->test_example($example_id, $function_basename);
            }
        }

        // restores the user language
        $this->_language->language_id = $language_id;

        $is_function_available = $this->_function->function_exists(true);

        return [$test_results, $is_function_available];
    }

    function validate_test_result($test_result, $expected_result, $example_id)
    {
        if ($this->_function->test_not_validated === true or in_array($example_id, (array) $this->_function->test_not_validated)) {
            // the test is considered always valid for this function, eg random generators, list of functions or constants etc.
            $test_validation['status'] = 'test_not_validated';

        } else if ($test_result === $expected_result) {
            // both test and expected results are strickly the same
            $test_validation['status'] = 'test_success';

        } else if (! isset($expected_result['result'])) {
            $test_validation['status'] = 'test_failed';

        } else if (! isset($test_result['result'])) {
            $test_validation['status'] = 'test_failed';
            $expected_value = current($expected_result['result']);

        } else  {
            $test_value = current($test_result['result']);
            $expected_value = current($expected_result['result']);

            if (is_float($test_value) and
                (is_int($expected_value) or is_float($expected_value)) and
                (is_nan($test_value) and is_nan($expected_value) or abs($test_value - $expected_value) < 0.00001))
            {
                // the test value is a float and the expected value is an integer or a float, they are equal with a precision of 5 digits
                // note that an expected value being store as eg "123" is interpreted as an integer by PHP
                // note that float numbers might not be strickly equal due to floating precision limitation
                $test_validation['status'] = 'test_success';

            } else if (is_object($test_value) and is_object($expected_value) and
                       $this->object_export($test_value) == $this->object_export($expected_value))
            {
                // both test and expected values share the same class and properties
                $test_validation['status'] = 'test_success';

            } else {
                $test_validation['status'] = 'test_failed';
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
                $test_validation['status'] = 'test_missing';

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
