<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class translator extends object
{
    const ANY_LANGUAGE = '*';

    function _get_translators()
    {
        $translators_filename = $this->get_translators_filename();
        $translators = $this->_file->read_array($translators_filename);

        return $translators;
    }

    function deobfuscate_email($obfuscated_email)
    {
        $email = base64_decode(str_rot13($obfuscated_email));

        return $email;
    }

    function get_inactive_translators($active_translators, $language_id)
    {
        $inactive_translators = [];

        foreach ($this->translators as $obfuscated_email => $language_ids) {
            $email = $this->deobfuscate_email($obfuscated_email);

            if (! isset($active_translators[$email]) and preg_match("~\b$language_id\b~", $language_ids)) {
                $inactive_translators[] = $email;
            }
        }

        return $inactive_translators;
    }

    function get_login_urls($email, $language_ids)
    {
        if ($language_ids == self::ANY_LANGUAGE) {
            $language_ids = ['fr'];
        } else {
            $language_ids = explode(',', $language_ids);
        }

        $translation_key = $this->hash_translation_key($email);

        foreach ($language_ids as $language_id) {
            $urls[$language_id] = "http://micmap.org/php-by-example/$language_id/messages_translation?email=$email&translation_key=$translation_key";
        }

        return $urls;
    }

    function get_translation_key()
    {
        $translation_key = require sprintf('%s/data/translation_key.php', $this->application_path);

        return $translation_key;
    }

    function get_translators_filename()
    {
        $translators_filename = sprintf('%s/data/translators.php', $this->application_path);

        return $translators_filename;
    }

    function hash_translation_key($email)
    {
        $translation_key = $this->get_translation_key();
        $hashed_translation_key = hash_hmac('md5', $translation_key, $email);

        return $hashed_translation_key;
    }

    function is_valid_translation_key($hashed_translation_key, $email)
    {
        $is_valid_translation_key = $hashed_translation_key == $this->hash_translation_key($email);

        return $is_valid_translation_key;
    }

    function is_valid_translator($email, $language_id = null)
    {
        if (! $language_id) {
            $language_id = $this->_language->language_id;
        }

        $translators = $this->_get_translators();
        $email = $this->obfuscate_email($email);

        if (! isset($translators[$email])) {
            return false;
        }

        $translator_allowed_languages = $translators[$email];
        $is_valid_translator = ($translator_allowed_languages == self::ANY_LANGUAGE or preg_match("~\b$language_id\b~", $translator_allowed_languages));

        return $is_valid_translator;
    }

    function obfuscate_email($email)
    {
        $obfuscated_email = str_rot13(base64_encode($email));

        return $obfuscated_email;
    }

    function show_translators($email_pattern = null)
    {
        $translators = $this->_get_translators();
        $translators_details = [];

        foreach ($translators as $obfuscated_email => $language_ids) {
            $email = $this->deobfuscate_email($obfuscated_email);

            if (! $email_pattern or preg_match("~" . preg_quote($email_pattern) . "~", $email)) {
                $hashed_translation_key = $this->hash_translation_key($email);
                $login_urls = $this->get_login_urls($email, $language_ids);
                $login_urls = implode("\n", $login_urls);
                $translators_details[$email] = [$email, $obfuscated_email, $language_ids, $hashed_translation_key, $login_urls];
            }
        }

        ksort($translators_details);

        return $translators_details;
    }

    function update_translator($email, $language_ids)
    {
        $translators = $this->_get_translators();
        $obfuscated_email = $this->obfuscate_email($email);

        if ($language_ids and
            $language_ids != self::ANY_LANGUAGE and
            ! $language_ids = $this->_language->is_valid_languages($language_ids))
        {
            throw new Exception('unexpected language id');
        }

        $updated_translators = $translators;

        if ($language_ids) {
            $updated_translators[$obfuscated_email] = $language_ids;
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

        return [$is_translator_updated, $language_ids];
    }
}
