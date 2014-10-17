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

class strncasecmp extends function_core
{
    public $examples = [
        ["abc", "DEF", 1]
    ];

    public $synopsis = 'int strncasecmp ( string $str1 , string $str2 , int $len )';
}
