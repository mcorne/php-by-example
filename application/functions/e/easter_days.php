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

class easter_days extends function_core
{
    public $examples = [1999, 1492, 1913];

    public $synopsis = 'int easter_days ([ int $year [, int $method = CAL_EASTER_DEFAULT ]] )';
}
