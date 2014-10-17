<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * adds, updates or removes a translator
 * returns the login url
 */

if (empty($argv[1])) {
    $help =
"
Usage:
update_translator <email> [languages]

email      the translator email
languages  the translator language, eg 'fr' or 'ro,ru'
           or leave empty to remove the translator

Examples:
update_translator jsmith@email.com fr
update_translator jsmith@email.com 'ro,ru'
update_translator jsmith@email.com
";
    exit($help);
}

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/translator.php';

try {
    $translator = new translator(['application_path' => $application_path]);
    $email = $argv[1];
    $language_ids = isset($argv[2]) ? $argv[2] : null;
    list($is_translator_updated, $updated_language_ids) = $translator->update_translator($email, $language_ids);

    if ($language_ids) {
        $result = $is_translator_updated ? 'translator added/updated successfully' : 'no change';
    } else {
        $result = $is_translator_updated ? 'translator removed successfully' : 'unknown translator';
    }

    echo $result;

    if ($updated_language_ids) {
        $urls = $translator->get_login_urls($email, $updated_language_ids);
        echo "\n" . implode("\n", $urls);
    }

} catch (Exception $e) {
    echo $e->getMessage();
}
