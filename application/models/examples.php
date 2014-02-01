<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class examples extends object
{
    function _get_example($example_id)
    {
        if (! $this->examples) {
            return [];
        }

        if (! $example_id or ! array_key_exists($example_id, $this->examples)) {
            $example_id = key($this->examples);
        }

        $example = $this->examples[$example_id];
        $example = $this->combine_arg_names_to_example_values($example);

        return $example;
    }

    function combine_arg_name_to_example_value($index, $value)
    {
        if (isset($this->_synopsis->arg_names[$index])) {
            $arg_name = $this->_synopsis->arg_names[$index];

        } else if (is_int($index)) {
            throw new Exception("unmapped example key: $index");

        } else {
            $arg_name = $index;
        }

        // forces quotes around a constant for the "constant" function (this is a special case)
        $force_quotes = $this->_synopsis->function_name == 'constant';

        $combined[$arg_name] = $this->_converter->convert_value_to_text($value, false, $force_quotes);

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
}
