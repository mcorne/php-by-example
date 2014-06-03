<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
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
update_translator <email> [language]

email      the translator email
language   the translator language, eg 'fr',
           or leave empty to remove the translator

Examples:
update_translator jsmith@email.com 'fr'
update_translator jsmith@email.com
";
    exit($help);
}

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/translation.php';

try {
    $translation = new translation(['application_path' => $application_path]);
    $email = $argv[1];
    $language_id = isset($argv[2]) ? $argv[2] : null;
    $is_translator_updated = $translation->update_translator($email, $language_id);

    if ($language_id) {
        $result = $is_translator_updated ? 'translator added/updated successfully' : 'no change';
    } else {
        $result = $is_translator_updated ? 'translator removed successfully' : 'unknown translator';
    }

    echo $result;

    if ($language_id and $language_id != translation::ANY_LANGUAGE) {
        echo "\n" . $translation->get_login_url($email, $language_id);
    }

} catch (Exception $e) {
    echo $e->getMessage();
}
