<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class input_test extends unit_test_core
{
    function _get_double_slash_test()
    {
        ini_set('highlight.comment', '#123123');
        $results['color']   = $this->test_method([], '<span style="color: #123123">//</span>');

        /**********/

        ini_set('highlight.comment', '');
        $results['default'] = $this->test_method([], '<span style="color: #FF8000">//</span>');

        return $results;
    }
}
