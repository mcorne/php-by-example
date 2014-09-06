<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * updates the translation of the source code messages
 */

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/object.php';

class update_translations extends object
{
    function display_updated_translation_ids($updated_translation_ids)
    {
        foreach ($updated_translation_ids as $language_id => $message_ids) {
            $message_ids = implode(', ', $message_ids) ?: 'no change';
            $displayed[] = "$language_id : $message_ids";
        }

        $displayed = implode("\n", $displayed);

        return $displayed;
    }

    function get_validated_translations()
    {
        $translations_log_entries = $this->_translation->_get_translations_log_entries();
        $validated_translations = [];
        $updated_translation_ids = [];

        foreach ($this->_message_translation->english_messages as $message_id => $english_message) {
            if (! ($message_id % 100)) {
                $validated_translation = $english_message;

            } else if (isset($translations_log_entries[$message_id]) and
                $validated_translation = $this->_translation->get_validated_translation($translations_log_entries[$message_id]))
            {
                if ($validated_translation != $this->_message_translation->get_translated_message($message_id)) {
                    $updated_translation_ids[] = $message_id;
                }
            } else {
                $validated_translation = $this->_message_translation->get_translated_message($message_id);
            }

            $validated_translations[$message_id] = $validated_translation;
        }

        return [$validated_translations, $updated_translation_ids];
    }

    function run($selected_language_ids)
    {
        $languages = $this->_language->languages;
        unset($languages['en']);
        $language_ids = array_keys($this->_language->languages);

        if ($selected_language_ids) {
            $language_ids = array_intersect($language_ids, $selected_language_ids);
        }

        foreach ($language_ids as $language_id) {
            $this->_language->language_id = $language_id;

            unset(
                $this->_translation->translations_log_filename,
                $this->_translation->translations_log_entries,
                $this->_message_translation->translated_messages_filename,
                $this->_message_translation->translated_messages);

            list($validated_translations, $updated_translation_ids[$language_id]) = $this->get_validated_translations();

            if ($validated_translations != $this->_message_translation->_get_translated_messages(true)) {
                 $this->_file->write_array(
                     $this->_message_translation->translated_messages_filename,
                     $validated_translations,
                     [
                         '~^ *\d\d00 =>~um' => "\n" . '$0', // adds a blank line before a section, eg "1000 => ..."
                         '~^ +~m'           => '',          // removes leading spaces
                     ],
                     'preg_replace');
            }
        }

        return $updated_translation_ids;
    }
}

if (empty($argv[1])) {
    $help =
"
Usage:
update_translations <languages|*>

languages  the translation languages, eg 'fr' or 'ro,ru'
*          update all languages

Examples:
update_translations fr
update_translations 'ro,ru'
update_translations *
";
    exit($help);
}

try {
    $update_translations = new update_translations(['application_path' => $application_path, 'application_env' => 'development']);
    $language_ids = $argv[1] != '*' ? explode(',' , $argv[1]) : null;
    $updated_translation_ids = $update_translations->run($language_ids);
    echo $update_translations->display_updated_translation_ids($updated_translation_ids);

} catch (Exception $e) {
    echo $e->getMessage();
}
