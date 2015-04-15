#!/usr/bin/php
<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * downloads the manuals
 */

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/object.php';

class download_manuals extends object
{
    public $help = "
        Usage:
        download_manuals <languages|*>

        languages  the translation languages, eg 'fr' or 'ro,ru'
        *          download all manuals

        Examples:
        download_manuals fr
        download_manuals 'ro,ru'
        download_manuals *
        ";

    function download_all_manuals($selected_language_ids)
    {
        $language_ids = array_keys($this->_language->languages);

        if ($selected_language_ids) {
            $language_ids = array_intersect($language_ids, $selected_language_ids);
        }

        foreach ($language_ids as $language_id) {
            echo "$language_id: ";
            $is_manual_new = $this->download_manual($language_id);
            echo $is_manual_new ? 'new manual' : 'manual unchanged';
            echo "\n";
        }
    }

    function download_manual($language_id)
    {
        $fixed_language_id = $language_id == 'pt' ? 'pt_BR' : $language_id;
        $url = sprintf('http://php.net/get/php_manual_%s.tar.gz/from/this/mirror', $fixed_language_id);

        if (! $content = @file_get_contents($url)) {
            throw new Exception("cannot read $url");
        }

        $manual_filename = sprintf('%s/../download/php_manual_%s.tar.gz', $this->public_path, $language_id);

        if ($is_manual_new = $this->is_manual_new($manual_filename, $content)) {
            $this->write_manual($manual_filename, $content);
        }

        return $is_manual_new;
    }

    function get_help()
    {
        $help = trim($this->help);
        $help = preg_replace('~^ {8}~m', '', $help);

        return $help;
    }

    function is_manual_new($manual_filename, $content)
    {
        if (! file_exists($manual_filename)) {
            return true;
        }

        $is_manual_new = md5($content) != md5_file($manual_filename);

        return $is_manual_new;
    }

    static function run()
    {
        global $application_path, $argv;

        try {
            $download_manuals = new download_manuals(['public_path' => "$application_path/../public", 'application_env' => 'development']);

            if (empty($argv[1]) or in_array($argv[1], ['h', '-h'])) {
                throw new Exception($download_manuals->get_help());
            }

            $language_ids = $argv[1] != '*' ? explode(',' , $argv[1]) : null;
            $download_manuals->download_all_manuals($language_ids);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function write_manual($manual_filename, $content)
    {
        $dir = dirname($manual_filename);

        if (! file_exists($dir) and ! mkdir($dir, 0777, true)) {
            throw new Exception("cannot mkdir $dir");
        }

        if (! file_put_contents($manual_filename, $content)) {
            throw new Exception("cannot write $manual_filename");
        }
    }
}

download_manuals::run();