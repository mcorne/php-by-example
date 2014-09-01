<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * message translation
 * the translations are located in the "data/translations" directory
 */

class message_translation extends object
{
    function _get_english_messages()
    {
        $english_messages_filename = sprintf('%s/data/translations/en.php', $this->application_path);
        $english_messages = $this->_file->read_array($english_messages_filename);

        return $english_messages;
    }

    function _get_message_count()
    {
        $message_count = 0;

        foreach (array_keys($this->english_messages) as $message_id) {
            if ($message_id % 100) {
                $message_count++;
            }
        }

        return $message_count;
    }

    function _get_message_ids()
    {
        $english_messages = $this->english_messages;
        $message_ids = array_flip($english_messages);

        return $message_ids;
    }

    function _get_translated_messages($including_obsolete = false)
    {
        $translated_messages_filename = $this->translated_messages_filename;
        $translated_messages = $this->_file->read_array($translated_messages_filename);

        if (! $including_obsolete) {
            $translated_messages = array_intersect_key($translated_messages, $this->english_messages);
        }

        return $translated_messages;
    }

    function _get_translated_messages_filename()
    {
        $translated_messages_filename = sprintf('%s/data/translations/%s.php', $this->application_path, $this->_language->language_id);

        return $translated_messages_filename;
    }

    function get_message_last_proposed_translation($message, $message_id)
    {
        if ($this->_language->language_id != 'en') {
            // gets the current translation of the message
            $translation_log_entries = $this->_translation->get_translation_log_entries($message_id);
            $last_translation_log_entry = end($translation_log_entries);
            $message = $last_translation_log_entry['translated_message'];
        }

        $message = htmlspecialchars($message);

        if (! $this->_params->no_auto_highlight) {
            // hightlights the message
            $message = "<span class='highlight_translation_in_action'>$message</span>";
        }
        // else: the message must be highlighted specifically if the span ag may not be added within another tag, eg "option", "input" etc.

        return $message;
    }

    function get_message_translation_in_production($message)
    {
        if ($this->_language->language_id != 'en' and isset($this->message_ids[$message])) {
            $message_id = $this->message_ids[$message];

            if (isset($this->translated_messages[$message_id])) {
                // the message has a translation, returns the translation
                $message = $this->translated_messages[$message_id];
            }
        }

        $message = htmlspecialchars($message);

        return $message;
    }

    function get_translated_message($message_id)
    {
        if (! $message_id or ! isset($this->translated_messages[$message_id])) {
            $translated_message = null;
        } else {
            $translated_message = $this->translated_messages[$message_id];
        }

        return $translated_message;
    }

    function get_translated_messages_filemtime()
    {
        if (! file_exists($this->translated_messages_filename)) {
            return null;
        }

        $translated_messages_filename = filemtime($this->translated_messages_filename);

        return $translated_messages_filename;
    }

    function translate($message, $not_translated_part = null)
    {
        if ($this->_params->translation_in_action and
            isset($this->message_ids[$message]) and
            $this->message_ids[$message] == $this->_params->translation_in_action)
        {
            // this is a translation request for the given message as part of the translation process, see translation_form.phtml
            $message = $this->get_message_last_proposed_translation($message, $this->message_ids[$message]);

        } else {
            // this a regular translation request
            $message = $this->get_message_translation_in_production($message);
        }

        if ($not_translated_part) {
            $message .= htmlspecialchars(" ($not_translated_part)");
        }

        return $message;
    }
}
