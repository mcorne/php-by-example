<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * checks source code message translations
 */

class check_translations
{
    function __construct()
    {
        $this->english_messages = require __DIR__ . '/../application/data/translations/en.php';
    }

    function check_translated_messages()
    {
        $english_message_ids = array_keys($this->english_messages);
        $filenames = glob(__DIR__ . '/../application/data/translations/*.php');
        $missing_translated_message_ids = [];
        $obsolete_translated_message_ids = [];

        foreach ($filenames as $filename) {
            $translated_message_ids = array_keys(require $filename);
            $language_id = basename($filename, '.php');


            foreach (array_diff($english_message_ids, $translated_message_ids) as $id) {
                if (! isset($missing_translated_message_ids[$id])) {
                    $missing_translated_message_ids[$id] = $language_id;
                } else {
                    $missing_translated_message_ids[$id] .= ", $language_id";
                }
            }

            foreach (array_diff($translated_message_ids, $english_message_ids) as $id) {
                if (! isset($obsolete_translated_message_ids[$id])) {
                    $obsolete_translated_message_ids[$id] = $language_id;
                } else {
                    $obsolete_translated_message_ids[$id] .= ", $language_id";
                }
            }
        }

        return [$missing_translated_message_ids, $obsolete_translated_message_ids];
    }

    function display_messages($messages)
    {
        if (! $messages) {
            return null;
        }

        $messages = "\n\"" . implode("\"\n\"", $messages) . '"';

        return $messages;
    }

    function display_message_ids($message_ids)
    {
        if (! $message_ids) {
            return null;
        }

        foreach ($message_ids as $id => &$language_ids) {
            $language_ids = "$id = $language_ids";
        }

        $message_ids = implode(' ; ', $message_ids);

        return $message_ids;
    }

    function get_obsolete_english_messages($source_code_messages)
    {
        $english_messages = array_flip($this->english_messages);
        $source_code_messages = array_fill_keys($source_code_messages, true);
        $obsolete_english_message_ids = array_diff_key($english_messages, $source_code_messages);
        $obsolete_english_message_ids = array_filter($obsolete_english_message_ids, function($id) { return $id % 100; });

        return $obsolete_english_message_ids;
    }

    function get_source_code_messages()
    {
        $filenames = array_merge(glob(__DIR__ . '/../application/models/*.php'), glob(__DIR__ . '/../application/views/*.phtml'));
        $messages = [];

        foreach ($filenames as $filename) {
            $content = file_get_contents($filename);

            if (preg_match_all('~->translate\((["\'])(.+?)\1~s', $content, $matches)) {
                $messages = array_merge($messages, $matches[2]);
            }
        }

        $messages = array_unique($messages);

        return $messages;
    }

    function run()
    {
        list($missing_translated_message_ids, $obsolete_translated_message_ids) = $this->check_translated_messages();
        $source_code_messages = $this->get_source_code_messages();
        $missing_english_messages = array_diff($source_code_messages, $this->english_messages);
        $obsolete_english_message_ids = $this->get_obsolete_english_messages($source_code_messages);

        echo 'missing translated message ids  : ' . ($this->display_message_ids($missing_translated_message_ids) ?: 'none') . "\n";
        echo 'obsolete translated message ids : ' . ($this->display_message_ids($obsolete_translated_message_ids) ?: 'none') . "\n";
        echo 'obsolete english message ids    : ' . (implode(', ', $obsolete_english_message_ids) ?: 'none') . "\n";
        echo 'missing english messages        : ' . ($this->display_messages($missing_english_messages) ?: 'none') . "\n";
    }
}

$check_translations = new check_translations();
$check_translations->run();