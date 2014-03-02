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
 *
 * the translations are located in the "data/translations" directory
 */

class translator extends object
{
    function _get_message_ids()
    {
        $english_messages = $this->get_english_messages();
        $message_ids = array_flip($english_messages);

        return $message_ids;
    }

    function _get_translated_messages()
    {
        $translated_messages_filename = sprintf('%s/data/translations/%s.php', $this->application_path, $this->_language->language_id);
        $translated_messages = $this->_file->read_array($translated_messages_filename);

        return $translated_messages;
    }

    function get_english_messages()
    {
        $english_messages_filename = sprintf('%s/data/translations/en.php', $this->application_path);
        $english_messages = $this->_file->read_array($english_messages_filename);

        return $english_messages;
    }

    function translate($message, $not_translated_part = null)
    {
        if ($this->_language->language_id != 'en' and isset($this->message_ids[$message])) {
            // the language is not English and the message is to be translated
            $message_id = $this->message_ids[$message];

            if (isset($this->translated_messages[$message_id])) {
                // the message has a translation, returns the translation
                $message = $this->translated_messages[$message_id];
            }
        }

        if ($not_translated_part) {
            $message .= " ($not_translated_part)";
        }

        return htmlspecialchars($message);
    }
}
