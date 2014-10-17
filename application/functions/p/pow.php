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

class pow extends function_core
{
    public $examples = [
        [2, 8],
        [-1, 20],
        [0, 0],
        [-1, 5.5],
    ];

    public $synopsis = 'number pow ( number $base , number $exp )';
}
