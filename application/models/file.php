<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * file management
 */

class file extends object
{
    public $temp_filenames;

    function __destruct()
    {
        $this->delete_temp_files();
    }

    function _get_temp_file_prefix()
    {
        if (! $this->temp_filenames) {
            // there is no temp file yet, creates a temp file
            // this temp file will not be used, one temp file is needed at least to get the temp file prefix
            // note that the temp file prefix may be different depending on the platform
            $this->create_temp_file();
        }

        list($temp_file_prefix) = explode('pbe', $this->temp_filenames[0]);
        $temp_file_prefix .= 'pbe';

        return $temp_file_prefix;
    }

    function append_csv_line($filename, $array)
    {
        // replaces tabs with spaces since a tab is used as cell separator
        $array = str_replace("\t", ' ', $array);
        $line = implode("\t", $array);

        // replaces line breaks with their string equivalent since a line break is used as line separator
        // note that line break string equivalents should be replaced back to their original value after reading the line
        $line = str_replace("\n", '\n', $line);

        $directory = dirname($filename);

        if (! is_dir($directory)) {
            $this->create_directory($directory);
        }

        if (! @file_put_contents($filename, $line . "\n", FILE_APPEND | LOCK_EX)) {
            throw new Exception("cannot append file $filename");
        }
    }

    function combine_keys_to_lines($keys, $lines)
    {
        $lines_with_keys = [];

        foreach ($lines as $values) {
            $lines_with_keys[] = array_combine($keys, $values);
        }

        return $lines_with_keys;
    }

    function create_directory($directory)
    {
        if (! @mkdir($directory)) {
            throw new Exception('cannot create directory');
        }
    }

    function create_temp_file()
    {
        if (! $temp_filename = @tempnam(sys_get_temp_dir(), 'pbe')) {
            throw new Exception('cannot create temp file');
        }

        $this->temp_filenames[] = $temp_filename;

        return $temp_filename;
    }

    function delete_file($filename)
    {
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    function delete_temp_files()
    {
        if ($this->temp_filenames) {
            array_map([$this, 'delete_file'], $this->temp_filenames);
        }
    }

    function index_lines($lines, $index_key)
    {
        $indexed_last_lines = [];

        foreach ($lines as $line) {
            $key = $line[$index_key];
            $indexed_last_lines[$key][] = $line;
        }

        return $indexed_last_lines;
    }

    function read_array($filename)
    {
        if (! file_exists($filename)) {
            return [];
        }

        $array = include $filename;

        return $array;
    }

    function read_content($filename)
    {
        if (! $content = @file_get_contents($filename)) {
            throw new Exception("cannot read file $filename");
        }

        return $content;
    }

    function read_csv_lines($filename, $keys = null, $pattern = null, $index_key = null)
    {
        if (! file_exists($filename)) {
            return [];
        }

        if (! $lines = @file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)) {
            throw new Exception("cannot read file $filename");
        }

        if ($pattern) {
            $lines = preg_grep($pattern, $lines);
        }

        $lines = array_map(function($line) { return explode("\t", $line); }, $lines);

        if ($keys) {
            $lines = $this->combine_keys_to_lines($keys, $lines);
        }

        if ($index_key) {
            $lines = $this->index_lines($lines, $index_key);
        }

        return $lines;
    }

    function write_array($filename, $array, $replacements = [], $replacement_method = 'str_replace')
    {
        $format =
'<?php
// generated automatically %s
return %s;';

        $exported_array = var_export($array, true);

        if ($replacements) {
            $exported_array = $replacement_method(array_keys($replacements), array_values($replacements), $exported_array);
        }

        // adds the current date and time in the file header
        date_default_timezone_set('UTC');
        $content = sprintf($format, date('c'), $exported_array);
        $this->write_content($filename, $content);
    }

    function write_content($filename, $content)
    {
        if (! @file_put_contents($filename, $content)) {
            throw new Exception("cannot write file $filename");
        }
    }
}
