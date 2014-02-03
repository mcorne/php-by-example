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

    function read_array($filename)
    {
        if (! file_exists($filename)) {
            return [];
        }

        $array = include $filename;

        return $array;
    }

    function write_array($filename, $array, $replacements = [])
    {
        $format =
'<?php
// generated automatically %s
return %s;';

        $exported_array = var_export($array, true);

        if ($replacements) {
            $exported_array = str_replace(array_keys($replacements), array_values($replacements), $exported_array);
        }

        // adds the current date and time in the file header
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
