<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class translation extends object
{
    const MAX_LOCK_DURATION = 180; // seconds

    public $keys = ['message_id', 'date', 'translator', 'action', 'translated_message', 'comment'];

    function __construct($mixed = null)
    {
        date_default_timezone_get('UTC');
        parent::__construct($mixed);
    }

    function _get_translations_last_version()
    {
        $translations_last_version = [];

        foreach ($this->_message_translation->translated_messages as $message_id => $translation_last_version) {
            if (isset($this->translations_log_entries[$message_id])) {
                $translation_last_log_entry = end($this->translations_log_entries[$message_id]);
                $translation_last_version = $translation_last_log_entry['translated_message'];
            }

            $translations_last_version[$message_id] = $translation_last_version;
        }

        return $translations_last_version;
    }

    function _get_translations_log_entries()
    {
        $translations_log_entries =  $this->_file->read_csv_lines($this->translations_log_filename, $this->keys, null, 'message_id');

        return $translations_log_entries;
    }

    function _get_translations_log_filename()
    {
        $translations_log_filename = sprintf('%s/data/translations.%s.log/%s.csv', $this->application_path, $this->application_env, $this->_language->language_id);

        return $translations_log_filename;
    }

    function add_translation_first_log_entry($message_id)
    {
        $translation = $this->_message_translation->get_translated_message($message_id);
        // sets the time of the initial translation to the time of translation file
        $time = $this->_message_translation->get_translated_messages_filemtime();
        $translation_first_log_entry = $this->add_translation_log_entry($message_id, 'machine', 'added', $translation, null, $time);

        return $translation_first_log_entry;
    }

    function add_translation_log_entry($message_id, $translator, $action, $translation, $comment = null, $time = null)
    {
        $date = date('Y-m-d H:i:s', $time ?: time());
        $translation_log_entry = array_combine($this->keys, [$message_id, $date, $translator, $action, $translation, $comment]);
        $this->_file->append_csv_line($this->translations_log_filename, $translation_log_entry);

        return $translation_log_entry;
    }

    function calculate_language_translation_stats()
    {
        $machine_translation_ids = [];
        $fixed_translation_ids = [];
        $validated_translation_ids = [];

        foreach (array_keys($this->_message_translation->english_messages) as $message_id) {
            if (! ($message_id % 100)) {
                continue;
            }

            if (! isset($this->translations_log_entries[$message_id])) {
                $machine_translation_ids[] = $message_id;

            } else {
                do {
                    $translation_log_entry = array_pop($this->translations_log_entries[$message_id]);
                } while ($translation_log_entry['action'] == 'reviewed');

                if (count($translation_log_entry) == 1) {
                    $machine_translation_ids[] = $message_id;

                } else if ($translation_log_entry['action'] == 'validated') {
                    $validated_translation_ids[] = $message_id;

                } else {
                    $fixed_translation_ids[] = $message_id;
                }
            }
        }

        return [$machine_translation_ids, $fixed_translation_ids, $validated_translation_ids];
    }

    function calculate_language_translators_stats($language_id)
    {
        $translations_log_entries = $this->_file->read_csv_lines($this->translations_log_filename, $this->keys);
        rsort($translations_log_entries);

        $obfuscate_email = (! $this->_translator->is_valid_translator($this->_params->email, $language_id) or
                            ! $this->_translator->is_valid_translation_key($this->_params->translation_key, $this->_params->email));

        $translators_stats = [];

        foreach ($translations_log_entries as $translation_log_entry) {
            $translator = $translation_log_entry['translator'];

            if ($translator == 'machine' or ! $translation_log_entry['action'] == 'added' and ! $translation_log_entry['action'] == 'validated') {
                continue;
            }

            if (! isset($translators_stats[$translator])) {
                $translators_stats[$translator] = [
                    'email'                        => $translator,
                    'fixed_translations_count'     => 0,
                    'has_account'                  => $this->_translator->is_valid_translator($translator, $language_id),
                    'language_id'                  => $language_id,
                    'last_input_date'              => $translation_log_entry['date'],
                    'obfuscate_email'              => $obfuscate_email,
                    'translations_total'           => 0,
                    'validated_translations_count' => 0,
                ];
            }

            if ($translation_log_entry['action'] == 'added') {
                $translators_stats[$translator]['fixed_translations_count']++;

            } else {
                $translators_stats[$translator]['validated_translations_count']++;
            }

            $translators_stats[$translator]['translations_total']++;
        }

        $inactive_translators = $this->_translator->get_inactive_translators($translators_stats, $language_id);

        foreach ($inactive_translators as $inactive_translator) {
                $translators_stats[$inactive_translator] = [
                    'email'                        => $inactive_translator,
                    'fixed_translations_count'     => 0,
                    'has_account'                  => true,
                    'language_id'                  => $language_id,
                    'last_input_date'              => null,
                    'obfuscate_email'              => $obfuscate_email,
                    'translations_total'           => 0,
                    'validated_translations_count' => 0,
                ];
        }

        ksort($translators_stats);
        $translators_stats = array_values($translators_stats);

        return $translators_stats;
    }

    function count_translations_to_validate($by_translator_only)
    {
        $count = $this->_message_translation->message_count;

        foreach (array_keys($this->_message_translation->english_messages) as $message_id) {
            if (isset($this->translations_log_entries[$message_id])) {
                $translation_log_entries = $this->translations_log_entries[$message_id];

                if (! $this->is_translation_to_validate($by_translator_only, $translation_log_entries)) {
                    $count--;
                }
            }
        }

        return $count;
    }

    function get_next_translation_to_validate($by_translator_only)
    {
        foreach (array_keys($this->_message_translation->english_messages) as $message_id) {
            if ($message_id % 100) {
                if (! isset($this->translations_log_entries[$message_id])) {
                    $this->translations_log_entries[$message_id][] = $this->add_translation_first_log_entry($message_id);
                    return $message_id;
                }

                $translation_log_entries = $this->translations_log_entries[$message_id];

                if ($this->is_translation_to_validate($by_translator_only, $translation_log_entries)) {
                    return $message_id;
                }
            }
        }

        return null;
    }

    function get_translation_log_entries($message_id)
    {
        $message_id_pattern = '~^' . $message_id . '\t~';

        if (! $translation_log_entries =  $this->_file->read_csv_lines($this->translations_log_filename, $this->keys, $message_id_pattern)) {
            $translation_log_entries[] = $this->add_translation_first_log_entry($message_id);
        }

        return $translation_log_entries;
    }

    function get_validated_translation($translation_log_entries)
    {
        $last_added_translation = null;

        while ($translation_log_entry = array_pop($translation_log_entries)) {
            if ($translation_log_entry['action'] == 'validated') {
                return $translation_log_entry['translated_message'];

            } else if (! isset($last_added_translation)) {
                $last_added_translation = $translation_log_entry['translated_message'];
            }
        }

        // returns the last added translation if none has been validated yet as it is assumed to be better than the machine translation
        return $last_added_translation;
    }

    function is_translation_locked_for_review($translation_log_entry)
    {
        if ($translation_log_entry['action'] == 'reviewed' and $translation_log_entry['translator'] != $this->_params->email) {
            $timeout = strtotime($translation_log_entry['date']) + self::MAX_LOCK_DURATION;
            $is_translation_locked_for_review = $timeout > time() ? $timeout : false;

        } else {
            $is_translation_locked_for_review = false;
        }

        return $is_translation_locked_for_review;
    }

    function is_translation_to_validate($by_translator_only, $translation_log_entries)
    {
        $is_last_entry = true;

        while ($translation_log_entry = array_pop($translation_log_entries)) {
            if ($translation_log_entry['action'] == 'added') {
                // this translation needs validation
                if ($translation_log_entry['translator'] == $this->_params->email) {
                    // the translator has added this translation and may not validate it
                    return null;
                }

                return true;
            }

            if ($translation_log_entry['action'] == 'validated') {
                if (! $by_translator_only or $translation_log_entry['translator'] == $this->_params->email) {
                    // the translation has been validated already by someone or the translator only
                    return false;
                }

            } else if ($is_last_entry and $this->is_translation_locked_for_review($translation_log_entry)) {
                return false;
            }

            $is_last_entry = false;
        }

        return false;
    }
}
