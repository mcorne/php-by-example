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
 * returns the list of see also functions from the manual page
 */

class see_also_function extends object
{
    function extract_see_also_functions($content)
    {
        if (! preg_match('~<div class="refsect1 seealso"(.+)</div>~s', $content, $match) or
            ! preg_match_all('~rel="rdfs-seeAlso">([\w:]+)\(\)~', $match[1], $matches))
        {
            return null;
        }

        $manual_see_also_functions = $matches[1];

        return $manual_see_also_functions;
    }

    function get_manual_see_also_functions()
    {
        if (! $content = $this->read_manual_page_content()) {
            return null;
        }

        $manual_see_also_functions = $this->extract_see_also_functions($content);

        return $manual_see_also_functions;
    }

    function read_manual_page_content($must_exist = false)
    {
        $manual_page_file_name = sprintf('%s/manual/en/%s.html', $this->public_path, $this->_synopsis->manual_function_name);

        if (! file_exists($manual_page_file_name)) {
            // although unlikely a manual page might not be found any more after a PHP manual update
            // silently ignores the issue so this remains transparent to the user
            return null;
        }

        $content = $this->_file->read_content($manual_page_file_name);

        return $content;
    }
}
