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

class getmxrr extends function_core
{
    public $examples = [
        ['www.example.com', '$mxhosts'],
        ['domainmx.net', '$mxhosts']
    ];

    public $synopsis = 'bool getmxrr ( string $hostname , array &$mxhosts [, array &$weight ] )';

    public $test_not_to_run = true;
}
