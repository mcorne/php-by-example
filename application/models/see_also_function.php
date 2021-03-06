<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * returns the list of see also functions from the manual page
 */

class see_also_function extends object
{
    function _get_see_also_functions()
    {
        $see_also_functions = (array) $this->_function->see_also ?: [];

        if ($manual_see_also_functions = $this->get_manual_see_also_functions()) {
            $see_also_functions = array_merge($see_also_functions, $manual_see_also_functions);
        }

        if ($this->_function_list->function_matches) {
            $see_also_functions = array_merge($see_also_functions, $this->_function_list->function_matches);
        }

        if ($source_code_functions = $this->get_source_code_functions()) {
            $see_also_functions = array_merge($see_also_functions, $source_code_functions);
        }

        if ($source_code_methods = $this->get_source_code_methods()) {
            $see_also_functions = array_merge($see_also_functions, $source_code_methods);
        }

        if ($parent_function = $this->get_parent_function()) {
            $see_also_functions[] = $this->_function_list->function_list[$parent_function];
        }

        $see_also_functions = array_unique($see_also_functions);
        $see_also_functions = array_intersect($see_also_functions, $this->_function_list->function_list);

        if ($source_code_custom_functions = $this->get_source_code_custom_functions()) {
            $see_also_functions = array_merge($see_also_functions, $source_code_custom_functions);
        }

        if ($this->_function->is_hashed_result_notice) {
            $see_also_functions[] = 'pbx_hash';
        }

        $see_also_functions = array_diff($see_also_functions, [$this->_synopsis->function_name]);
        sort($see_also_functions);

        return $see_also_functions;
    }

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

    function get_parent_function()
    {
        $parent_function = get_parent_class($this->_function);

        if ($parent_function == 'function_core') {
            return null;
        }

        return $parent_function;
    }

    function get_source_code_custom_functions()
    {
        if (! preg_match_all('~(pbx_\w+)~s', $this->_function->source_code, $match)) {
            return null;
        }

        $source_code_custom_functions = array_unique($match[1]);

        return $source_code_custom_functions;
    }

    function get_source_code_functions()
    {
        // matches function names excluding method names
        if (! preg_match_all('~(?<!->)\b(\w+)\(~s', $this->_function->source_code, $match)) {
            return null;
        }

        $source_code_functions = array_unique($match[1]);

        return $source_code_functions;
    }

    function get_source_code_methods()
    {
        // eg "pdo->exec"
        if (! preg_match_all('~(\w+->\w+)\(~s', $this->_function->source_code, $match)) {
            return null;
        }

        $source_code_methods = [];

        foreach (array_unique($match[1]) as $source_code_method) {
            $function_basename = str_replace('->', '__', $source_code_method);
            $function_basename = strtolower($function_basename);

            if (isset($this->_function_list->function_list[$function_basename])) {
                $source_code_methods[] = $this->_function_list->function_list[$function_basename];
            }
        }

        return $source_code_methods;
    }

    function read_manual_page_content($must_exist = false)
    {
        $manual_page_filename = sprintf('%s/manual/en/%s.html', $this->public_path, $this->_output->manual_function_name);

        if (! file_exists($manual_page_filename)) {
            // although unlikely a manual page might not be found any more after a PHP manual update
            // silently ignores the issue so this remains transparent to the user
            return null;
        }

        $content = $this->_file->read_content($manual_page_filename);

        return $content;
    }
}
