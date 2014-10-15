<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/g/get_cfg_var.php';

class ini_get extends get_cfg_var
{
    public $examples = ["display_errors", "register_globals", "post_max_size"];

    public $synopsis = 'string ini_get ( string $varname )';
}
