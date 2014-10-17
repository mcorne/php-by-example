<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class abs_test extends unit_test_core
{
    function init_test()
    {
        $test_examples = $this->_abs->examples;
        $test_examples[9] = str_repeat('a', 1000 + 1);
        $expected_properties = [ ['abs', 'examples', $test_examples] ];
        $results['init'] = $this->test_method([], null, false, $expected_properties);

        return $results;
    }
}
