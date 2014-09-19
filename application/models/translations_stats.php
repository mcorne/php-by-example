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

class translations_stats extends action
{
    function run()
    {
        $current_language_id = $this->_language->language_id;

        foreach ($this->_language->languages as $language_id => $language) {
            if ($language_id != 'en') {
                $this->_translation->reset_dynamic_properties();
                $this->_language->language_id = $language_id;

                list($machine_translation_ids, $fixed_translation_ids, $validated_translation_ids) = $this->_translation->calculate_language_translation_stats();

                $language_english_name = $language['english_name'];

                $machine_translation_count = count($machine_translation_ids);
                $fixed_translation_count = count($fixed_translation_ids);
                $translations_to_validate_count = $machine_translation_count + $fixed_translation_count;
                $validated_translation_count      = count($validated_translation_ids);

                $translations_stats[$language_english_name] = [
                    'language_id'                    => $language_id,
                    'machine_translations_count'     => $machine_translation_count,
                    'fixed_translations_count'       => $fixed_translation_count,
                    'translations_to_validate_count' => $translations_to_validate_count,
                    'validated_translations_count'   => $validated_translation_count,
                    'translations_total'             => $translations_to_validate_count + $validated_translation_count,
                    'translations_to_validate_ids'   => array_merge($fixed_translation_ids, $machine_translation_ids),
                ];
            }
        }

        ksort($translations_stats);
        $this->translations_stats = $translations_stats;

        $this->_language->language_id = $current_language_id;

        parent::run();
    }
}
