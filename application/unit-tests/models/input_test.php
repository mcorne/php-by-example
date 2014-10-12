<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class input_test extends unit_test_core
{
    function _get_double_slash_test()
    {
        $results['no-arg']  = $this->test_method([null                ], '<span style="color: #FF8000">//</span>');
        $results['color']   = $this->test_method(['color: #123123">//'], '<span style="color: #123123">//</span>');
        $results['default'] = $this->test_method(['xyz'               ], '<span style="color: #FF8000">//</span>');

        return $results;
    }
}
