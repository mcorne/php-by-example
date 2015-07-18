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
 * @see http://browscap.org/
 * @see https://github.com/GaretJax/phpbrowscap
 */

class get_browser extends function_core
{
    public $examples = [
        [null, true]
    ];

    public $method_to_exec = 'getBrowser';

    public $no_object_name = true;

    public $source_code = '
        inject_function_call

        // shows the HTTP User Agent
        $http_user_agent = $_SERVER["HTTP_USER_AGENT"];
    ';

    public $synopsis = 'mixed get_browser ([ string $user_agent [, bool $return_array = false ]] )';

    public $test_not_to_run = true;

    function post_exec_function()
    {
        $this->result['HTTP_USER_AGENT'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
    }

    function pre_exec_function()
    {
        $cache_dir = $this->application_path . '/data/browscap';

        if (! file_exists($cache_dir) and ! @mkdir($cache_dir)) {
            throw new Exception('Cannot create cache directory');
        }

        date_default_timezone_set('UTC'); // prevents the no time zone notice
        set_time_limit(10 * 60);          // increases the exec time for a slow download
        $this->object = new Browscap($cache_dir);
    }
}
