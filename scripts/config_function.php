<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * function configurator
 * creates a function configuration file in the "functions" directory to be adjusted manually as needed
 * run "config_function -h" to get help
 */

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'function_configurator.php';

try {
    $function_configurator = new function_configurator(['application_path' => $application_path]);
    $option = isset($argv[1]) ? $argv[1] : null;
    $functions = isset($argv[2]) ? $argv[2] : null;
    $synopsis_fixed = isset($argv[3]) ? $argv[3] : null;
    $configs = $function_configurator->make_functions_configs($option, $functions, $synopsis_fixed);
    echo $function_configurator->display_configs($configs);

} catch (Exception $e) {
    echo $e->getMessage();
}
