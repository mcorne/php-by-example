<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * obfuscates a translator email
 */

if (empty($argv[1])) {
    exit('usage: obfuscate_email <email> [-d]');
}

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/translation.php';

try {
    $translation = new translation(['application_path' => $application_path]);

    if (isset($argv[2])) {
        echo $translation->deobfuscate_email($argv[1]);
    } else {
        echo $translation->obfuscate_email($argv[1]);
    }

} catch (Exception $e) {
    echo $e->getMessage();
}
