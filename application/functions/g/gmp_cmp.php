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

class gmp_cmp extends function_core
{
    public $examples = [
        ["1234", "1000"],
        ["1000", "1234"],
        ["1234", "1234"]
    ];

    public $synopsis = 'int gmp_cmp ( resource $a , resource $b )';
}
