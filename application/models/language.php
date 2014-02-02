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
 * language detection
 * entry point: _get_language_id()
 */

class language extends object
{
    const DEFAULT_LANGUAGE = 'en';

    public $languages = [
        // 'zh' => 'Chinese', // (Simplified)
        'en' => 'English',
        'fr' => 'French',
        // 'de' => 'German',
        // 'it' => 'Italian',
        // 'ja' => 'Japanese',
        // 'pt' => 'Portuguese',
        // 'ro' => 'Romanian',
        // 'ru' => 'Russian',
        // 'es' => 'Spanish',
        // 'tr' => 'Turkish',
    ];
    function _get_language_id()
    {
        $language_id = isset($this->uri[0]) ? $this->uri[0] : null;

        if (! $this->is_valid_language($language_id)) {
            $language_id = $this->get_valid_browser_language();
        }

        return $language_id;
    }

    function fix_language_id($language_id)
    {
        $language_id = strtolower($language_id);
        // ignores the region from the language code
        list($language_id) = explode('-', $language_id);

        return $language_id;
    }

    function get_browser_languages()
    {
        if (! isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            return [];
        }

        // there are accepted languages, ex: "hu, en-us;q=0.66, en;q=0.33", "hu,en-us;q=0.5"
        // see http://tools.ietf.org/html/rfc2616#section-14.4
        $accepted_languages = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        $language_ids = [];

        foreach($accepted_languages as $accepted_language) {
            if (preg_match('~([a-z-]+)(?:;q=([0-9\\.]+))?~i', $accepted_language, $match)) {
                $language_id = $match[1];
                $quality  = isset($match[2]) ? (float) $match[2] : 1.0;  // defaults quality to 1
                $language_ids[$language_id] = $quality;
            }
        }

        // sorts the browser accepted languages ordered by highest quality first
        arsort($language_ids, SORT_NUMERIC);
        $language_ids = array_keys($language_ids);

        return $language_ids;
    }

    function get_valid_browser_language()
    {
        $language_ids = $this->get_browser_languages();

        foreach ($language_ids as $language_id) {
            $language_id = $this->fix_language_id($language_id);

            if ($this->is_valid_language($language_id)) {
                return $language_id;
            }
        }

        return self::DEFAULT_LANGUAGE;
    }

    function is_valid_language($language_id)
    {
        $is_valid = isset($this->languages[$language_id]);

        return $is_valid;
    }
}
