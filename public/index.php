<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// exit('PHP By Example is down for maintenance. Sorry for the inconvenience. Please, come back soon.');

// sets the application path
// php-by-example domain subpath autodetection, default is none
$is_domain_subpath = strpos($_SERVER['REQUEST_URI'], '/php-by-example') === 0;
$application_path = $is_domain_subpath ? '/../../cgi-bin/php-by-example' : '/../application';
// $application_path = '/../application';     // installation with no domain subpath, eg local installation
// $application_path = '/../../cgi-bin/xyz';  // installation with "xyz" domain subpath

$application_path = realpath(__DIR__ . $application_path);
set_include_path($application_path);

$base_url = sprintf('http://%s', $_SERVER['HTTP_HOST']);

if ($is_domain_subpath) {
    $base_url .= '/php-by-example';
}

require_once 'models/application.php';

$config = [
    'application_env'  => getenv('ENVIRONMENT'),
    'application_path' => $application_path,
    'base_url'         => $base_url,
    'public_path'      => __DIR__,
];

$application = new application($config);
$application->run();
