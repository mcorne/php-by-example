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

class base_convert extends function_core
{
    public $examples = [
        ['A37334', 16, 2],
        [255, 10, 16]
    ];

    public $synopsis = 'string base_convert ( string $number , int $frombase , int $tobase )';
}
