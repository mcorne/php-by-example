<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * update the manuals
 */

$application_path = realpath(__DIR__ . '/../application');
set_include_path("$application_path");
require_once 'models/object.php';

class update_manuals extends object
{
    function decompress_manual($manual_filename_gz, $manual_filename)
    {
        @unlink($manual_filename);

        $archive = new PharData($manual_filename_gz);
        $archive->decompress();
    }

    function display_updated_manuals_status($updated_manuals)
    {
        foreach ($updated_manuals as $language_id => $status) {
            $displayed[] = "$language_id : $status";
        }

        $displayed = implode("\n", $displayed);

        return $displayed;
    }

    function extract_manual($manual_filename, $temp_dirname)
    {
        $this->remove_directory($temp_dirname);

        $archive = new PharData($manual_filename);
        $download_directory = dirname($manual_filename);
        $archive->extractTo($download_directory);
    }

    function is_manual_up_to_date($manual_filename_md5, $md5)
    {
        if (! file_exists($manual_filename_md5)) {
            return false;
        }

        $is_manual_up_to_date = file_get_contents($manual_filename_md5) == $md5;

        return $is_manual_up_to_date;
    }

    function move_manual($manual_dirname, $temp_dirname)
    {
        $this->remove_directory($manual_dirname);

        if (! rename($temp_dirname, $manual_dirname)) {
            throw new Exception("cannot rename $temp_dirname");
        }
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

    function run($selected_language_ids)
    {
        $language_ids = array_keys($this->_language->languages);

        if ($selected_language_ids) {
            $language_ids = array_intersect($language_ids, $selected_language_ids);
        }

        $updated_manuals = [];

        foreach ($language_ids as $language_id) {
            echo "$language_id ";

            $manual_filename     = sprintf('%s/manual/download/php_manual_%s.tar', $this->public_path, $language_id);
            $manual_filename_gz  = "$manual_filename.gz";
            $manual_filename_md5 = "$manual_filename_gz.md5";
            $temp_dirname        = sprintf('%s/manual/download/php-chunked-xhtml', $this->public_path);
            $manual_dirname      = sprintf('%s/manual/%s', $this->public_path, $language_id);

            if (! file_exists($manual_filename_gz)) {
                $updated_manuals[$language_id] = '.tar.gz missing, no change';
                continue;
            }

            $md5 = md5_file($manual_filename_gz);

            if ($this->is_manual_up_to_date($manual_filename_md5, $md5)) {
                $updated_manuals[$language_id] = 'already up to date, no change';
                continue;
            }

            $this->decompress_manual($manual_filename_gz, $manual_filename);
            $this->extract_manual($manual_filename, $temp_dirname);
            $this->move_manual($manual_dirname, $temp_dirname);
            $this->write_manual_md5($manual_filename_md5, $md5);

            $updated_manuals[$language_id] = 'updated successfully';
        }

        echo "\n";

        return $updated_manuals;
    }

    function write_manual_md5($manual_filename_md5, $md5)
    {
        if (! file_put_contents($manual_filename_md5, $md5)) {
            throw new Exception("cannot write $manual_filename_md5");
        }
    }
}

if (empty($argv[1])) {
    $help =
"
Usage:
update_manuals <languages|*>

languages  the translation languages, eg 'fr' or 'ro,ru'
*          update all manuals

Examples:
update_manuals fr
update_manuals 'ro,ru'
update_manuals *
";
    exit($help);
}

try {
    $update_manuals = new update_manuals(['public_path' => "$application_path/../public", 'application_env' => 'development']);
    $language_ids = $argv[1] != '*' ? explode(',' , $argv[1]) : null;
    $updated_manuals = $update_manuals->run($language_ids);
    echo $update_manuals->display_updated_manuals_status($updated_manuals);

} catch (Exception $e) {
    echo $e->getMessage();
}

echo "\n";
