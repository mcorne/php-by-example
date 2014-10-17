<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/g/get_cfg_var.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class ini_get extends get_cfg_var
{
    public $examples = ["display_errors", "register_globals", "post_max_size"];

    public $synopsis = 'string ini_get ( string $varname )';
}
