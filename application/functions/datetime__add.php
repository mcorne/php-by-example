<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class datetime__add extends function_core
{
    public $source_code = '
$date = new DateTime(
    $time // [string $time = "now"]
);
$_interval = new DateInterval(
    $interval_spec // string $interval_spec
)
$date->inject_function_call
$_format =
    $format; // string $format
$string = $date->format($format);
';

    public $examples = [
        [
            'time'          => '2000-01-01',
            'interval_spec' => 'P10D',
            '$interval',
            'format'        => 'Y-m-d',
        ],
        [
            'time'          => '2000-01-01',
            'interval_spec' => 'PT10H30S',
            '$interval',
            'format'        => 'Y-m-d H:i:s',
        ],
        [
            'time'          => '2000-01-01',
            'interval_spec' => 'P7Y5M4DT4H3M2S',
            '$interval',
            'format'        => 'Y-m-d H:i:s',
        ],
        [
            'time'          => '2000-12-31',
            'interval_spec' => 'P1M',
            '$interval',
            'format'        => 'Y-m-d',
        ],
        [
            'time'          => '2000-12-31',
            'interval_spec' => 'P2M',
            '$interval',
            'format'        => 'Y-m-d',
        ],
    ];

    public $input_args = ['time', 'interval_spec'];

    public $synopsis = 'public DateTime DateTime::add ( DateInterval $interval )';

    function post_exec_function()
    {
        $format = $this->_filter->filter_date_format();
        $this->result['string'] = $this->object->format($format);
    }

    function pre_exec_function()
    {
        $this->returned_params['interval'] = $this->_filter->filter_date_interval();
        $this->object = $this->_filter->filter_date_time();
    }
}
