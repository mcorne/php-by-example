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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class mhash_get_block_size extends function_core
{
    public $constant_prefix = ['hash' => 'MHASH'];

    public $examples = ["MHASH_MD5"];

    public $synopsis = 'int mhash_get_block_size ( int $hash )';
}
