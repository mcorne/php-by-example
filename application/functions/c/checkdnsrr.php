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

class checkdnsrr extends function_core
{
    public $examples = ["php.net"];

    public $options_list = ['type' => ['A', 'MX', 'NS', 'SOA', 'PTR', 'CNAME', 'AAAA', 'A6', 'SRV', 'NAPTR', 'TXT', 'ANY']];

    public $synopsis = 'bool checkdnsrr ( string $host [, string $type = &quot;MX&quot; ] )';

    public $test_not_to_run = true;
}
