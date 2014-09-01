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
 * messages translation interface
 */

class messages_translation extends action
{
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

    function get_message_id($select_action)
    {
        $message_id = $this->_params->get_param($select_action);

        if (! isset($this->_message_translation->english_messages[$message_id])) {
            $message_id = null;
        }

        return $message_id;
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

    function is_select_message_action()
    {
        $action = $this->get_action();

        if ($action != 'select_message') {
           $action = null;
        }

        return $action;
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

        } else if (! $this->_translator->is_valid_translator($this->_params->email)) {
            $this->status = 'invalid_translator';
            $this->no_additional_action = true;

        } else if (! $this->_translator->is_valid_translation_key($this->_params->translation_key, $this->_params->email)) {
            $this->status = 'invalid_translation_key';
            $this->no_additional_action = true;
        }

        return empty($this->status);
    }

    function process_next_translation_to_validate()
    {
        if ($this->message_id = $this->_translation->get_next_translation_to_validate(false)) {
            $translation_log_entries = $this->_translation->get_translation_log_entries($this->message_id);
            $last_translation_log_entry = end($translation_log_entries);
            $this->_translation->add_translation_log_entry($this->message_id, $this->_params->email, 'reviewed', $last_translation_log_entry['translated_message']);
            $this->status = 'translation_needs_validation';
            $this->validate_or_change = true;

        } else if ($this->message_id = $this->_translation->get_next_translation_to_validate(true)) {
            $translation_log_entries = $this->_translation->get_translation_log_entries($this->message_id);
            $last_translation_log_entry = end($translation_log_entries);
            $this->_translation->add_translation_log_entry($this->message_id, $this->_params->email, 'reviewed', $last_translation_log_entry['translated_message']);
            $this->status = 'you_could_double_check_this_translation';
            $this->validate_or_change = true;
        } else {
             $this->next_action = 'no_validation_needed';
        }
    }

    function process_save_translation($message_id)
    {
        $translation_log_entries = $this->_translation->get_translation_log_entries($message_id);
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
            $is_translation_to_validate_by_translator = $this->_translation->is_translation_to_validate(true, $translation_log_entries);

            if ($is_translation_to_validate_by_translator === false) {
                $this->status = 'you_already_validated_this_translation';
                $this->set_next_action();

            } else if ($is_translation_to_validate_by_translator === null) {
                $this->status = 'you_may_not_validate_your_translation';
                $this->set_next_action();

            } else {
                $this->_translation->add_translation_log_entry($message_id, $this->_params->email, 'validated', $translated_message, $this->_params->get_param('comment'));
                $this->status = 'translation_validated_successfully';
                $this->set_next_action();
            }

        } else { // new translation added
            $this->_translation->add_translation_log_entry($message_id, $this->_params->email, 'added', $translated_message, $this->_params->get_param('comment'));
            $this->status = 'translation_added_successfully';
            $this->set_next_action();
        }

        $this->message_id = $message_id;
    }

    function process_selected_message($message_id)
    {
        $translation_log_entries = $this->_translation->get_translation_log_entries($message_id);
        $last_translation_log_entry = end($translation_log_entries);

        if ($last_translation_log_entry['action'] == 'added') {
            if ($last_translation_log_entry['translator'] == $this->_params->email) {
                $this->status = 'you_may_not_validate_your_translation';
                $this->set_next_action();

            } else {
                $this->status = 'translation_needs_validation';
                $this->validate_or_change = true;
            }

        } else if ($this->_translation->is_translation_locked_for_review($last_translation_log_entry)) {
            $this->status = 'translation_being_reviewed_by_another_translator';
            $this->set_next_action();
            $this->no_display_translation_input = true;

        } else  { // reviewed or validated
            if ($this->_translation->is_translation_to_validate(false, $translation_log_entries)) {
                $this->status = 'translation_needs_validation';
                $this->validate_or_change = true;

            } else if ($this->_translation->is_translation_to_validate(true, $translation_log_entries)) {
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
                $this->_translation->get_translation_log_entries($this->message_id);
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
        if ($this->translations_count = $this->_translation->count_translations_to_validate(false)) {
            $this->next_action = 'translations_need_your_validation';

        } else if ($this->translations_count = $this->_translation->count_translations_to_validate(true)) {
             $this->next_action = 'translations_could_be_double_checked_by_you';

        } else {
             $this->next_action = 'no_validation_needed';
        }
    }
}
