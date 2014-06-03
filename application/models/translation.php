<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';

/**
 * message translation management
 */

class translation extends action
{
    const ANY_LANGUAGE = '*';
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

        foreach ($this->_translator->translated_messages as $message_id => $translation_last_version) {
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
        $translation = $this->_translator->get_translated_message($message_id);
        // sets the time of the initial translation to the time of translation file
        $time = $this->_translator->get_translated_messages_filemtime();
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

    function count_translations_to_validate($by_translator_only)
    {
        $count = $this->_translator->message_count;

        foreach (array_keys($this->_translator->english_messages) as $message_id) {
            if (isset($this->translations_log_entries[$message_id])) {
                $translation_log_entries = $this->translations_log_entries[$message_id];

                if (! $this->is_translation_to_validate($by_translator_only, $translation_log_entries)) {
                    $count--;
                }
            }
        }

        return $count;
    }

    function deobfuscate_email($obfuscated_email)
    {
        $email = base64_decode(str_rot13($obfuscated_email));

        return $email;
    }

    function get_action()
    {
        static $allowed_actions = [
            'get_next_translation_to_validate',
            'save_translation',
            'select_message'
        ];

        $action = $this->_params->get_param('translation_action');

        if (! in_array($action, $allowed_actions)) {
            $action = null;
        }

        return $action;
    }

    function get_login_url($email, $language_id)
    {
        $translation_key = $this->hash_translation_key($email);
        $url = "http://micmap.org/php-by-example/$language_id/translation?email=$email&translation_key=$translation_key";

        return $url;
    }

    function get_message_id($select_action)
    {
        $message_id = $this->_params->get_param($select_action);

        if (! isset($this->_translator->english_messages[$message_id])) {
            $message_id = null;
        }

        return $message_id;
    }

    function get_next_translation_to_validate($by_translator_only)
    {
        foreach (array_keys($this->_translator->english_messages) as $message_id) {
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

    function get_translation_in_action_url($message_id)
    {
        $translation_in_action_urls = require sprintf('%s/data/translations_in_action.php', $this->application_path);

        if (! isset($translation_in_action_urls[$message_id])) {
            return null;
        }

        $url = (array) $translation_in_action_urls[$message_id];

        if (isset($url['translation_note'])) {
            $translation_note = $url['translation_note'];
            unset($url['translation_note']);
        }

        // gets the url params to be passed to output::display_url() in translation_form.phtml
        $url = array_pad($url, 3, null);
        $url = array_combine(['action', 'function_name', 'params'], $url);

        // passes the translation in action id as a param to output::display_url()
        $url['params'] .= $url['params'] ? '&' : '?';
        $url['params'] .= "translation_in_action=$message_id";

        if (isset($translation_note)) {
            $url['translation_note'] = $translation_note;
        }

        return $url;
    }

    function get_translation_key()
    {
        $translation_key = require sprintf('%s/data/translation_key.php', $this->application_path);

        return $translation_key;
    }

    function get_translation_log_entries($message_id)
    {
        $message_id_pattern = '~^' . $message_id . '\t~';

        if (! $translation_log_entries =  $this->_file->read_csv_lines($this->translations_log_filename, $this->keys, $message_id_pattern)) {
            $translation_log_entries[] = $this->add_translation_first_log_entry($message_id);
        }

        return $translation_log_entries;
    }

    function get_translators()
    {
        $translators_filename = $this->get_translators_filename();
        $translators = $this->_file->read_array($translators_filename);

        return $translators;
    }

    function get_translators_filename()
    {
        $translators_filename = sprintf('%s/data/translators.php', $this->application_path);

        return $translators_filename;
    }

    function get_validated_translation($translation_log_entries)
    {
        while ($translation_log_entry = array_pop($translation_log_entries)) {
            if ($translation_log_entry['action'] == 'validated') {
                return $translation_log_entry['translated_message'];
            }
        }

        return null;
    }

    function hash_translation_key($email)
    {
        $translation_key = $this->get_translation_key();
        $hashed_translation_key = hash_hmac('md5', $translation_key, $email);

        return $hashed_translation_key;
    }

    function is_select_message_action()
    {
        $action = $this->get_action();

        if ($action != 'select_message') {
           $action = null;
        }

        return $action;
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

    function is_valid_translation_key($hashed_translation_key, $email)
    {
        $is_valid_translation_key = $hashed_translation_key == $this->hash_translation_key($email);

        return $is_valid_translation_key;
    }

    function is_valid_translator($email)
    {
        $translators = $this->get_translators();
        $email = $this->obfuscate_email($email);

        if (! isset($translators[$email])) {
            return false;
        }

        $translator_allowed_languages = $translators[$email];
        $is_valid_translator = ($translator_allowed_languages == self::ANY_LANGUAGE or in_array($this->_language->language_id, (array) $translator_allowed_languages));

        return $is_valid_translator;
    }

    function obfuscate_email($email)
    {
        $obfuscated_email = str_rot13(base64_encode($email));

        return $obfuscated_email;
    }

    function process_credentials()
    {
        if ($this->_params->logoff) {
            $this->_params->reset_cookie_param('email');
            $this->_params->reset_cookie_param('translation_key');
        }

        if (! $this->_params->email) {
            $this->status = 'empty_email';
            $this->no_additional_action = true;

        } else if (! $this->is_valid_translator($this->_params->email)) {
            $this->status = 'invalid_translator';
            $this->no_additional_action = true;

        } else if (! $this->is_valid_translation_key($this->_params->translation_key, $this->_params->email)) {
            $this->status = 'invalid_translation_key';
            $this->no_additional_action = true;
        }

        return empty($this->status);
    }

    function process_next_translation_to_validate()
    {
        if ($this->message_id = $this->get_next_translation_to_validate(false)) {
            $translation_log_entries = $this->get_translation_log_entries($this->message_id);
            $last_translation_log_entry = end($translation_log_entries);
            $this->add_translation_log_entry($this->message_id, $this->_params->email, 'reviewed', $last_translation_log_entry['translated_message']);
            $this->status = 'translation_needs_validation';
            $this->validate_or_change = true;

        } else if ($this->message_id = $this->get_next_translation_to_validate(true)) {
            $translation_log_entries = $this->get_translation_log_entries($this->message_id);
            $last_translation_log_entry = end($translation_log_entries);
            $this->add_translation_log_entry($this->message_id, $this->_params->email, 'reviewed', $last_translation_log_entry['translated_message']);
            $this->status = 'you_could_double_check_this_translation';
            $this->validate_or_change = true;
        } else {
             $this->next_action = 'no_validation_needed';
        }
    }

    function process_save_translation($message_id)
    {
        $translation_log_entries = $this->get_translation_log_entries($message_id);
        $last_translation_log_entry = end($translation_log_entries);
        $translated_message = $this->_params->get_param('translated_message');

        if (! $translated_message) {
            $this->status = 'translation_may_not_be_empty';
            $this->validate_or_change = true;

        } else if ($last_translation_log_entry['translated_message'] != $this->_params->get_param('previous_translated_message')) {
            $this->status = 'translation_changed_in_the_mean_time_by_another_translator';
            $this->validate_or_change = true;
            $this->translation_not_processed = $translated_message;

        } else if ($last_translation_log_entry['translated_message'] == $translated_message) {
            $is_translation_to_validate_by_translator = $this->is_translation_to_validate(true, $translation_log_entries);

            if ($is_translation_to_validate_by_translator === false) {
                $this->status = 'you_already_validated_this_translation';
                $this->set_next_action();

            } else if ($is_translation_to_validate_by_translator === null) {
                $this->status = 'you_may_not_validate_your_translation';
                $this->set_next_action();

            } else {
                $this->add_translation_log_entry($message_id, $this->_params->email, 'validated', $translated_message, $this->_params->get_param('comment'));
                $this->status = 'translation_validated_successfully';
                $this->set_next_action();
            }

        } else { // new translation added
            $this->add_translation_log_entry($message_id, $this->_params->email, 'added', $translated_message, $this->_params->get_param('comment'));
            $this->status = 'translation_added_successfully';
            $this->set_next_action();
        }

        $this->message_id = $message_id;
    }

    function process_selected_message($message_id)
    {
        $translation_log_entries = $this->get_translation_log_entries($message_id);
        $last_translation_log_entry = end($translation_log_entries);

        if ($last_translation_log_entry['action'] == 'added') {
            if ($last_translation_log_entry['translator'] == $this->_params->email) {
                $this->status = 'you_may_not_validate_your_translation';
                $this->set_next_action();

            } else {
                $this->status = 'translation_needs_validation';
                $this->validate_or_change = true;
            }

        } else if ($this->is_translation_locked_for_review($last_translation_log_entry)) {
            $this->status = 'translation_being_reviewed_by_another_translator';
            $this->set_next_action();
            $this->no_display_translation_input = true;

        } else  { // reviewed or validated
            if ($this->is_translation_to_validate(false, $translation_log_entries)) {
                $this->status = 'translation_needs_validation';
                $this->validate_or_change = true;

            } else if ($this->is_translation_to_validate(true, $translation_log_entries)) {
                $this->status = 'you_could_double_check_this_translation';
                $this->validate_or_change = true;

            } else {
                $this->status = 'you_already_validated_this_translation';
                $this->set_next_action();
            }
        }

        $this->message_id = $message_id;
    }

    function run()
    {
        $this->display_selects = true;

        if ($this->_language->language_id == 'en') {
            $this->status = 'no_translation_language';
            $this->no_additional_action = true;
            $this->display_selects = false;

        } else if (! $this->process_credentials()) {
            if ($action = $this->is_select_message_action()) {
                $this->message_id = $this->get_message_id($action);
                $this->get_translation_log_entries($this->message_id);
            }

        } else if (! $action = $this->get_action()) {
            $this->set_next_action();

        } else if ($action == 'get_next_translation_to_validate') {
            $this->process_next_translation_to_validate();

        } else if ($action == 'save_translation') {
            if ($message_id = $this->_params->message_to_validate_id) {
                $this->process_save_translation($message_id);
            } else {
                $this->set_next_action();
            }

        } else { // message selection
            if ($message_id = $this->get_message_id($action)) {
                $this->process_selected_message($message_id);
            } else {
                $this->set_next_action();
            }
        }

        parent::run();
    }

    function set_next_action()
    {
        if ($this->translations_count = $this->count_translations_to_validate(false)) {
            $this->next_action = 'translations_need_your_validation';

        } else if ($this->translations_count = $this->count_translations_to_validate(true)) {
             $this->next_action = 'translations_could_be_double_checked_by_you';

        } else {
             $this->next_action = 'no_validation_needed';
        }
    }

    function show_translators($email_pattern = null)
    {
        $translators = $this->get_translators();
        $translators_details = [];

        foreach ($translators as $obfuscated_email => $language_id) {
            $email = $this->deobfuscate_email($obfuscated_email);

            if (! $email_pattern or preg_match("~" . preg_quote($email_pattern) . "~", $email)) {
                $hashed_translation_key = $this->hash_translation_key($email);
                $login_url = $this->get_login_url($email, $language_id);
                $translators_details[$email] = [$email, $obfuscated_email, $language_id, $hashed_translation_key, $login_url];
            }
        }

        ksort($translators_details);

        return $translators_details;
    }

    function update_translator($email, $language_id)
    {
        $translators = $this->get_translators();
        $obfuscated_email = $this->obfuscate_email($email);

        if ($language_id and $language_id != self::ANY_LANGUAGE and ! $this->_language->is_valid_language($language_id)) {
            throw new Exception('unexpected language id');
        }

        $updated_translators = $translators;

        if ($language_id) {
            $updated_translators[$obfuscated_email] = $language_id;
            asort($updated_translators, SORT_STRING);
        } else {
            unset($updated_translators[$obfuscated_email]);
        }

        if ($updated_translators !=  $translators) {
            $translators_filename = $this->get_translators_filename();
            $this->_file->write_array($translators_filename, $updated_translators);
            $is_translator_updated = true;
        } else {
            $is_translator_updated = false;
        }

        return $is_translator_updated;
    }
}
