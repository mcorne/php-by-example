<?php
use phpbrowscap\Browscap;
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'external/Browscap.php';
require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class get_browser extends function_core
{
    public $examples = [
        [null, true]
    ];

    public $method_to_exec = 'getBrowser';

    public $synopsis = 'mixed get_browser ([ string $user_agent [, bool $return_array = false ]] )';

    public $test_not_to_run = true;

    function pre_exec_function()
    {
        $cache_dir = $this->application_path . '/data/browscap';
        $this->object = new Browscap($cache_dir);
    }
}
