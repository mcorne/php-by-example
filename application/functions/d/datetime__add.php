<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class datetime__add extends function_core
{
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
        // used in translations_in_action.php
        [
            'time'          => '2000-12-31',
            'interval_spec' => 'P2M',
            '$interval',
            'format'        => 'Y-m-d',
        ],
    ];

    public $input_args = ['time', 'interval_spec'];

    public $source_code = '
        date_default_timezone_set("UTC");
        $datetime = new DateTime(
            $time // [string $time = "now"]
        );
        $_interval = new DateInterval(
            $interval_spec // string $interval_spec
        );

        inject_function_call

        // shows the new datetime
        $_format =
            $format; // string $format
        $string = $date->format($format);
    ';

    public $synopsis       = 'public DateTime DateTime::add ( DateInterval $interval )';
    public $synopsis_fixed = 'DateTime::add ( DateInterval $interval )';

    function post_exec_function()
    {
        $format = $this->_filter->filter_arg_value('format');
        $this->result['string'] = $this->object->format($format);
    }

    function pre_exec_function()
    {
        date_default_timezone_set('UTC');
        $this->returned_params['interval'] = $this->_filter->filter_date_interval('interval_spec');
        $this->object = $this->_filter->filter_date_time('time');
    }
}
