#!/usr/bin/php
<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * updates the manuals
 */

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/object.php';

class update_manuals extends object
{
    public $help = "
        Usage:
        update_manuals <languages|*>

        languages  the translation languages, eg 'fr' or 'ro,ru'
        *          update all manuals

        Examples:
        update_manuals fr
        update_manuals 'ro,ru'
        update_manuals *
        ";

    function decompress_manual($manual_filename_gz, $manual_filename)
    {
        @unlink($manual_filename);

        $archive = new PharData($manual_filename_gz);
        $archive->decompress();
    }

    function extract_manual($manual_filename, $temp_dirname)
    {
        $this->remove_directory($temp_dirname);

        $archive = new PharData($manual_filename);
        $download_directory = dirname($temp_dirname);
        $archive->extractTo($download_directory);

        unset($archive);
        @unlink($manual_filename);
    }

    function get_help()
    {
        $help = trim($this->help);
        $help = preg_replace('~^ {8}~m', '', $help);

        return $help;
    }

    function get_manual_published_date($manual_dirname)
    {
        $index_filename = "$manual_dirname/index.html";

        if (! file_exists($index_filename) or ! $content = @file_get_contents($index_filename)) {
            return "cannot read $index_filename";
        }

        if (! preg_match('~<div class="pubdate">([^<]+)</div>~', $content, $match)) {
            return 'cannot extract published date';
        }

        $published_date = $match[1];

        return $published_date;
    }

    function is_manual_up_to_date($manual_filename_md5, $md5)
    {
        if (! file_exists($manual_filename_md5)) {
            return false;
        }

        $is_manual_up_to_date = file_get_contents($manual_filename_md5) == $md5;

        return $is_manual_up_to_date;
    }

    function move_files($from_directory, $to_directory)
    {
        if (! file_exists($from_directory)) {
            throw new Exception("invalid directory $from_directory");
        }

        if (! file_exists($to_directory) and ! mkdir($to_directory, 0777, true)) {
            throw new Exception("cannot mkdir $to_directory");
        }

        $from_filenames = glob("$from_directory/*");

        $added     = 0;
        $total     = 0;
        $unchanged = 0;
        $updated   = 0;

        foreach ($from_filenames as $from_filename) {
            if (is_dir($from_filename)) {
                continue;
            }

            $total++;

            $basename = basename($from_filename);
            $to_filename = "$to_directory/$basename";

            if (! file_exists($to_filename)) {
                $added += (int) @rename($from_filename, $to_filename);

            } elseif (filesize($from_filename) != filesize($to_filename) or md5_file($from_filename) != md5_file($to_filename)) {
                $updated += (int) @rename($from_filename, $to_filename);

            } else {
                $unchanged += (int) @unlink($from_filename);
            }
        }

        $errors = $total - $added - $unchanged - $updated;
        $status = "$added files added, $updated updated, $unchanged unchanged, $errors errors, $total total";

        return $status;
    }

    function move_manual($temp_dirname, $manual_dirname)
    {
        $status = $this->move_files($temp_dirname, $manual_dirname);
        $this->move_files("$temp_dirname/images", "$manual_dirname/images");

        @rmdir("$temp_dirname/images");
        @rmdir($temp_dirname);

        return $status;
    }

    function remove_directory($directory)
    {
        if (! file_exists($directory)) {
            return;
        }

        $filenames = glob("$directory/*");

        foreach ($filenames as $filename) {
            if (is_dir($filename)) {
                $this->remove_directory($filename);
            } else {
                unlink($filename);
            }
        }

        rmdir($directory);
    }

    static function run()
    {
        global $application_path, $argv;

        try {
            $update_manuals = new update_manuals(['public_path' => "$application_path/../public", 'application_env' => 'development']);

            if (empty($argv[1])) {
                throw new Exception($update_manuals->get_help());
            }

            $language_ids = $argv[1] != '*' ? explode(',' , $argv[1]) : null;
            $update_manuals->update_all_manuals($language_ids);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function update_all_manuals($selected_language_ids)
    {
        $language_ids = array_keys($this->_language->languages);

        if ($selected_language_ids) {
            $language_ids = array_intersect($language_ids, $selected_language_ids);
        }

        foreach ($language_ids as $language_id) {
            echo "$language_id: ";
            $status = $this->update_manual($language_id);
            echo $status . "\n";
        }
    }

    function update_manual($language_id)
    {
        $manual_filename     = sprintf('%s/../download/php_manual_%s.tar', $this->public_path, $language_id);
        $manual_filename_gz  = "$manual_filename.gz";
        $manual_filename_md5 = "$manual_filename_gz.md5";

        $manual_dirname      = sprintf('%s/manual/%s', $this->public_path, $language_id);
        $temp_dirname        = "$manual_dirname/php-chunked-xhtml";

        if (! file_exists($manual_filename_gz)) {
            return '.tar.gz missing, download the manual!';
        }

        $md5 = md5_file($manual_filename_gz);

        if ($this->is_manual_up_to_date($manual_filename_md5, $md5)) {
            $published_date = $this->get_manual_published_date($manual_dirname);
            return "already up to date, no change ($published_date)";
        }

        $this->decompress_manual($manual_filename_gz, $manual_filename);
        $this->extract_manual($manual_filename, $temp_dirname);
        $status = $this->move_manual($temp_dirname, $manual_dirname);
        $this->write_manual_md5($manual_filename_md5, $md5);

        $published_date = $this->get_manual_published_date($manual_dirname);

        return "$status ($published_date)";
    }

    function write_manual_md5($manual_filename_md5, $md5)
    {
        if (! file_put_contents($manual_filename_md5, $md5)) {
            throw new Exception("cannot write $manual_filename_md5");
        }
    }
}

update_manuals::run();