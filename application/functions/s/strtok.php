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

class strtok extends function_core
{
    public $examples = [
        [
            '_DOUBLE_QUOTES_This is\tan example\nstring_DOUBLE_QUOTES_',
            '_DOUBLE_QUOTES_ \n\t_DOUBLE_QUOTES_'
        ],
        '_DOUBLE_QUOTES_ \n\t_DOUBLE_QUOTES_',
        [
            "/something",
            "/"
        ],
        "/",
        [
            "/something",
            "/"
        ],
        "/"
    ];

    public $synopsis = 'string strtok ( string $str , string $token )';
}
