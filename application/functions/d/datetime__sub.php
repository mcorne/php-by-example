<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'datetime__add.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class datetime__sub extends datetime__add
{
    public $examples = [
        [
            'timezone'      => 'UTC',
            'time'          => '2000-01-20',
            'interval_spec' => 'P10D',
            '$interval',
            'format'        => 'Y-m-d',
        ],
        [
            'timezone'      => 'UTC',
            'time'          => '2000-01-20',
            'interval_spec' => 'PT10H30S',
            '$interval',
            'format'        => 'Y-m-d H:i:s',
        ],
        [
            'timezone'      => 'UTC',
            'time'          => '2000-01-20',
            'interval_spec' => 'P7Y5M4DT4H3M2S',
            '$interval',
            'format'        => 'Y-m-d H:i:s',
        ],
        [
            'timezone'      => 'UTC',
            'time'          => '2001-04-30',
            'interval_spec' => 'P1M',
            '$interval',
            'format'        => 'Y-m-d',
        ],
        [
            'timezone'      => 'UTC',
            'time'          => '2001-04-30',
            'interval_spec' => 'P2M',
            '$interval',
            'format'        => 'Y-m-d',
        ],
    ];

    public $synopsis       = 'public DateTime DateTime::sub ( DateInterval $interval )';
    public $synopsis_fixed = 'DateTime::sub ( DateInterval $interval )';
}
