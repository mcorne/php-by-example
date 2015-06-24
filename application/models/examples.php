<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * example values to arg names combination
 * entry point: get_example()
 */

class examples extends object
{
    function combine_arg_name_to_example_value($index, $value)
    {
        if (isset($this->_synopsis->arg_names[$index])) {
            $arg_name = $this->_synopsis->arg_names[$index];

        } else if (is_int($index)) {
            throw new Exception("unmapped example key: $index");

        } else {
            $arg_name = $index;
        }

        $combined[$arg_name] = $this->convert_example_to_text($value, false, $arg_name);

        return $combined;
    }

    function combine_arg_names_to_example_values($example)
    {
        $combined = [];

        if (is_null($example)) {
            $example = [null];
        } else  {
            $example = (array) $example;
        }

        foreach ($example as $index => $value) {
            $combined += $this->combine_arg_name_to_example_value($index, $value);
        }

        return $combined;
    }

    function convert_example_to_text($value, $no_linebreak = false, $arg_name)
    {
        $force_quotes = ! empty($this->_function->constant_as_string[$arg_name]);
        $text = $this->_converter->convert_value_to_text($value, $no_linebreak, $force_quotes, true);

        return $text;
    }

    function fix_example($example)
    {
        if (is_null($example)) {
            return null;
        }

        $example = (array) $example;

        foreach ($example as $key => &$value) {
            $value = $this->fix_temp_filename($value);
            $value = $this->remove_extra_indentations($value, $key);
        }

        return $example;
    }

    function fix_temp_filename($value)
    {
        if (is_string($value)) {
            $value = preg_replace('~^(file://)/tmp~', '$1' . sys_get_temp_dir(), $value);
            $value = preg_replace('~^/tmp~', sys_get_temp_dir(), $value);
            // doubles backslashes because strings are displayed between double quotes
            $value = str_replace('\\', '\\\\', $value);
        }

        return $value;
    }

    function get_example($example_id)
    {
        if (! $this->_function->examples) {
            return [];
        }

        if (! $example_id or ! array_key_exists($example_id, $this->_function->examples)) {
            // the example id is empty or invalid, defaults to the first example
            $example_id = key($this->_function->examples);
        }

        $example = $this->_function->examples[$example_id];
        $example = $this->fix_example($example);
        $example = $this->combine_arg_names_to_example_values($example);

        return $example;
    }

    function remove_extra_indentations($value, $key)
    {
        if (is_string($value) and strpos($value, "\n") !== false) {
            $extra_identations = is_int($key) ? '~^ {12}~m' : '~^ {16}~m';
            $value = preg_replace($extra_identations, '', $value);
        }

        return $value;
    }
}
