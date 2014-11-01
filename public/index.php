<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

// exit('PHP By Example is down for maintenance. Sorry for the inconvenience. Please, come back soon.');

if (getenv('ENVIRONMENT') == 'production') {
    $application_subpath = '/../../cgi-bin/php-by-example';
} else {
    $application_subpath = '/../application';
}

$application_path = realpath(__DIR__ . $application_subpath);
set_include_path($application_path);

$base_url = 'http://' . $_SERVER['HTTP_HOST'];

if (strpos($_SERVER['REQUEST_URI'], '/php-by-example') === 0) {
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
