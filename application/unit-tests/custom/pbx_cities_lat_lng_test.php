<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class pbx_cities_lat_lng_test extends unit_test_core
{
    function coordinate_to_float_test()
    {
        $results['north']   = $this->test_method(["51°30'N"]  , 51.5);
        $results['west']    = $this->test_method(["45°00'W"], (float) -45);
        $results['zero']    = $this->test_method(["0°00'E/W"] , (float) 0);
        $results['invalid'] = $this->test_method(["45°'E/W"]  , null);

        return $results;
    }
}
