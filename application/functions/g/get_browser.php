<?php
use phpbrowscap\Browscap;
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
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
        require_once $this->application_path . '/models/Browscap.php';
        $cache_dir = $this->application_path . '/data/browscap';
        $this->object = new Browscap($cache_dir);
    }
}
