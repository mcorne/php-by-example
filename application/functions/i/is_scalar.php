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

class is_scalar extends function_core
{
    public $examples = [
        3.1416,
        [
            ["hemoglobin", "cytochrome c oxidase", "ferredoxin"]
        ]
    ];

    public $synopsis = 'bool is_scalar ( mixed $var )';
}
