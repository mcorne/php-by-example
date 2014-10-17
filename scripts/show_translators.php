<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * shows the translators details
 */

if (empty($argv[1])) {
    $help =
"
Usage:
show_translators <email|part|*>

email      a translator email
part       an email substring or pattern
*          show all translators

Examples:
show_translators jsmith@email.com
show_translators jsmith
show_translators *
";
    exit($help);
}

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/translator.php';

try {
    $translator = new translator(['application_path' => $application_path]);
    $email_pattern = (isset($argv[1]) and $argv[1] != '*') ? $argv[1] : null;
    $translators_details = $translator->show_translators($email_pattern);

    foreach ($translators_details as &$translator_details) {
        $translator_details = implode("\n", $translator_details);
    }

    $translators_details = implode("\n\n", $translators_details);
    echo $translators_details;

} catch (Exception $e) {
    echo $e->getMessage();
}
