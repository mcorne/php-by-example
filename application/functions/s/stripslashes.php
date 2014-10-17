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

class stripslashes extends function_core
{
    public $examples = [
        '_DOUBLE_QUOTES_Is your name O\\\'reilly?_DOUBLE_QUOTES_',
        '_DOUBLE_QUOTES_f\\\'oo_DOUBLE_QUOTES_',
        '_DOUBLE_QUOTES_b\\\'ar_DOUBLE_QUOTES_',
    ];

    public $synopsis = 'string stripslashes ( string $str )';
}
