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

class vsprintf extends function_core
{
    public $examples = [
        [
            "%04d-%02d-%02d",
            [1998, 8, 1]
        ],
    ];

    public $synopsis = 'string vsprintf ( string $format , array $args )';
}
