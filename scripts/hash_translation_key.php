<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * hashes the translation key
 */

if (empty($argv[1])) {
    exit('usage: hash_translation_key <email>');
}

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/translation.php';

try {
    $translation = new translation(['application_path' => $application_path]);
    $email = $argv[1];
    echo $translation->hash_translation_key($email);

} catch (Exception $e) {
    echo $e->getMessage();
}
