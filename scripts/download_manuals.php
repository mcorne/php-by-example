<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
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
    function display_downloaded_manuals_status($downloaded_manuals)
    {
        foreach ($downloaded_manuals as $language_id => $is_new_manual) {
            $status = $is_new_manual ? 'new' : 'no change';
            $displayed[] = "$language_id : $status";
        }

        $displayed = implode("\n", $displayed);

        return $displayed;
    }

    function is_manual_new($manual_filename, $content)
    {
        if (! file_exists($manual_filename)) {
            return true;
        }

        $is_manual_new = md5($content) != md5_file($manual_filename);

        return $is_manual_new;
    }

    function run($selected_language_ids)
    {
        $language_ids = array_keys($this->_language->languages);

        if ($selected_language_ids) {
            $language_ids = array_intersect($language_ids, $selected_language_ids);
        }

        $downloaded_manuals = [];

        foreach ($language_ids as $language_id) {
            echo "$language_id ";

            $fixed_language_id = $language_id == 'pt' ? 'pt_BR' : $language_id;
            $url = sprintf('http://php.net/get/php_manual_%s.tar.gz/from/this/mirror', $fixed_language_id);

            if (! $content = file_get_contents($url)) {
                throw new Exception("cannot read $url");
            }

            $manual_filename = sprintf('%s/manual/download/php_manual_%s.tar.gz', $this->public_path, $language_id);

            if ($is_manual_new = $this->is_manual_new($manual_filename, $content)) {
                $this->write_manual($manual_filename, $content);
            }

            $downloaded_manuals[$language_id] = $is_manual_new;
        }

        echo "\n";

        return $downloaded_manuals;
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

if (empty($argv[1])) {
    $help =
"
Usage:
download_manuals <languages|*>

languages  the translation languages, eg 'fr' or 'ro,ru'
*          download all manuals

Examples:
download_manuals fr
download_manuals 'ro,ru'
download_manuals *
";
    exit($help);
}

try {
    $download_manuals = new download_manuals(['public_path' => "$application_path/../public", 'application_env' => 'development']);
    $language_ids = $argv[1] != '*' ? explode(',' , $argv[1]) : null;
    $downloaded_manuals = $download_manuals->run($language_ids);
    echo $download_manuals->display_downloaded_manuals_status($downloaded_manuals);

} catch (Exception $e) {
    echo $e->getMessage();
}

echo "\n";
