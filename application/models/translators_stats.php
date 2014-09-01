<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'action.php';
require_once 'translation.php';

class translators_stats extends action
{
    function run()
    {
        foreach ($this->_language->languages as $language_id => $language) {
            if ($language_id != 'en') {
                $translation = new translation(['application_path' => $this->application_path, 'application_env' => $this->application_env]);
                $translation->_language->language_id = $language_id;
                $language_english_name = $language['english_name'];
                $translators_stats[$language_english_name] = $translation->calculate_language_translators_stats($language_id);
            }
        }

        ksort($translators_stats);
        $this->translators_stats = $translators_stats;

        parent::run();
    }
}
