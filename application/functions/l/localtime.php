<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class localtime extends function_core
{
    public $examples = [
        [
            'time' => "2001-01-01 12:00:00",
            '$timestamp',
        ],
        [
            'time' => "2001-01-01 12:00:00",
            '$timestamp',
            true,
        ],
        [
            'time' => '',
            0,
            true,
        ],
        [
            'time' => '',
        ],
    ];

    public $source_code = '
        // enter a $_time or a $_timestamp
        $_timestamp = strtotime(
            $time // string $time
        );

        inject_function_call
    ';

    public $synopsis = 'array localtime ([ int $timestamp = time() [, bool $is_associative = false ]] )';

    public $test_not_validated = [1, 2];

    function pre_exec_function()
    {
        if ($time = $this->_filter->filter_arg_value('time')) {
            $this->returned_params['timestamp'] = strtotime($time);
        }
    }
}
