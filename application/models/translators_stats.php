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
        $current_language_id = $this->_language->language_id;

        foreach ($this->_language->languages as $language_id => $language) {
            if ($language_id != 'en') {
                $this->create_object('translation');
                $this->_language->language_id = $language_id;

                $language_english_name = $language['english_name'];
                $translators_stats[$language_english_name] = $this->_translation->calculate_language_translators_stats();
            }
        }

        ksort($translators_stats);
        $this->translators_stats = $translators_stats;

        $this->_language->language_id = $current_language_id;

        parent::run();
    }
}
