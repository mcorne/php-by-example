<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/e/exif_read_data.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class read_exif_data extends exif_read_data
{
    public $synopsis = 'array read_exif_data ( string $filename [, string $sections = NULL [, bool $arrays = false [, bool $thumbnail = false ]]] )';
}
