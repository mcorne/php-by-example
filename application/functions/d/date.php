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
 * @see docs/function-configuration.txt
 */

class date extends function_core
{
    public $constant_prefix = ['format' => 'DATE'];

    public $examples = [
        [
            'timezone' => "UTC",
            'l',
            962409600
        ],
        [
            'timezone' => "UTC",
            '_SINGLE_QUOTE_l jS \of F Y h:i:s A_SINGLE_QUOTE_',
            962409600
        ],
        [
            'timezone' => "UTC",
            'DATE_RFC2822',
            962409600
        ],
        [
            'timezone' => "UTC",
            'DATE_ATOM',
            962409600
        ],
        [
            'timezone' => "UTC",
            '_SINGLE_QUOTE_l \t\h\e jS_SINGLE_QUOTE_',
            962409600
        ],
        [
            'timezone' => "UTC",
            'F j, Y, g:i a',
            962409600
        ],
        [
            'timezone' => "UTC",
            'm.d.y',
            962409600
        ],
        [
            'timezone' => "UTC",
            'j, n, Y',
            962409600
        ],
        [
            'timezone' => "UTC",
            'Ymd',
            962409600
        ],
        [
            'timezone' => "UTC",
            'h-i-s, j-m-y, it is w Day',
            962409600
        ],
        [
            'timezone' => "UTC",
            '_SINGLE_QUOTE_\i\t \i\s \t\h\e jS \d\a\y._SINGLE_QUOTE_',
            962409600
        ],
        [
            'timezone' => "UTC",
            'D M j G:i:s T Y',
            962409600
        ],
        [
            'timezone' => "UTC",
            '_SINGLE_QUOTE_H:m:s \m \i\s\ \m\o\n\t\h_SINGLE_QUOTE_',
            962409600
        ],
        [
            'timezone' => "UTC",
            'H:i:s',
            962409600
        ],
        [
            'timezone' => "UTC",
            'Y-m-d H:i:s',
            962409600
        ],
    ];

    public $input_args = ['timezone'];

    public $source_code = '
        date_default_timezone_set(
            $timezone // string $timezone
        );

        inject_function_call
    ';

    public $options_getter = [
        'timezone' => ['DateTimeZone', 'listIdentifiers'],
    ];

    public $synopsis = 'string date ( string $format [, int $timestamp = time() ] )';

    function pre_exec_function()
    {
        if ($timezone = $this->_filter->filter_arg_value('timezone')) {
            date_default_timezone_set($timezone);
        }
    }
}
