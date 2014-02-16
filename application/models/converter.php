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
 * value to text conversion
 * entry point: convert_value_to_text()
 */

class converter extends object
{
    function convert_array_to_text($values, $no_linebreak = false, $force_quotes = false, $no_string_equivalent = false, $indentation = '  ', $level = 0)
    {
        $level++;

        foreach ($values as $key => &$value) {
            if (is_array($value)) {
                $value = $this->convert_array_to_text($value, $no_linebreak, $force_quotes, $no_string_equivalent, $indentation, $level);
            } else {
                $value = $this->convert_value_to_text($value, $no_linebreak, $force_quotes, $no_string_equivalent);
            }

            $key = $this->convert_value_to_text($key, $no_linebreak, $force_quotes, $no_string_equivalent);
            $value = "$key => $value";
        }

        if ($no_linebreak) {
            $glue = ', ';
            $text = '[' . implode($glue, $values) . ']';

        } else if (! $values) {
            $text = '[]';

        } else {
            $array_leading_spaces = str_repeat($indentation, $level - 1);
            $scalar_leading_spaces = str_repeat($indentation, $level);
            $text =  implode(",\n$scalar_leading_spaces", $values);
            $text =  "[\n$scalar_leading_spaces$text,\n$array_leading_spaces]";
        }

        $level--;

        return $text;
    }

    function convert_resource_to_text($value)
    {
        if (is_array($value)) {
            // recursively converts resource type values
            $text = array_map([$this, 'convert_resource_to_text'], $value);

        } else if (is_resource($value)) {
            // replaces the resource by its name
            $text = get_resource_type($value);

        } else {
            // this is not a resource, no change
            $text = $value;
        }

        return $text;
    }

    function convert_string_to_text($value, $no_linebreak, $force_quotes = false, $no_string_equivalent = false)
    {
        if (preg_match('~^(null|false|true)$~i', $value)) {
            // this is a string representation of a boolean or null
            $text = $no_string_equivalent ? "'$value'" : $value;

        } else if ($this->_params->is_param_var($value) or $this->is_constant($value)) {
            // this is a var, eg '$var', or a constant name, eg 'SORT_ASC'
            $text = $force_quotes ? "'$value'" : $value;

        } else {
            if ($no_linebreak) {
                // replaces line breaks with a space character
                $value = str_replace(["\r\n", "\n", "\r"], ' ', $value);
            }

            if (strpos($value, '$') !== false or                       // there are "$" in the string (1) or
                preg_match('~^([^a-z0-9\ %]).+\1[a-z]*$~is', $value) or // this is a regex pattern (2), encloses the string with single quotes or
                preg_match('~\\\\[1-9]\d?~', $value))                  // this is a regex replacement eg "\1"
            {
                // (1) note that parser::get_next_token() would not return a T_STRING if it was enclosed with double quotes
                // (2) note that backslashes would be difficult to handle properly to create a pattern between double quotes with the expected behaviour
                // note also that "%" is excluded from the list of delimiters although a valid one so sscanf() formats are not mistaken for regex patterns
                // see http://fr2.php.net/manual/en/regexp.reference.delimiters.php on regex pattern delimiters
                // note that line breaks, tabs etc. will not be replaced by their string equivalent which is acceptable
                $text = "'" . str_replace("'", "\'", $value) . "'";

            } else {
                // see http://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double
                // escapes backslashes and double quotes
                $value = str_replace(['\\', '"'], ['\\\\', '\"'], $value);

                if (! $no_string_equivalent) {
                    // replaces line breaks, tabs etc. by their string equivalent
                    $value = str_replace(["\n", "\r", "\t", "\v", "\e", "\f"], ['\n', '\r', '\t', '\v', '\e', '\f'], $value);
                }

                // encloses the string with double quotes
                $text = '"' . $value . '"';
            }
        }

        return $text;
    }

    function convert_value_to_text($value, $no_linebreak = false, $force_quotes = false, $no_string_equivalent = false, $indentation = '  ')
    {
        $type = gettype($value);

        switch($type) {
            case 'array':
                $text = $this->convert_array_to_text($value, $no_linebreak, $force_quotes, $no_string_equivalent, $indentation);
                break;

            case 'boolean':
                $text = $value? 'true' : 'false';
                break;

            case 'double':
            case 'float':
            case 'integer':
                $text = $value;
                break;

            case 'null':
            case 'NULL':
                $text = 'null';
                break;

            case 'string':
                $text = $this->convert_string_to_text($value, $no_linebreak, $force_quotes, $no_string_equivalent);
                break;

            default:
                throw new Exception("unexpected value with type: $type");
        }

        return $text;
    }

    function is_constant($value)
    {
        $constants = preg_split('~ *\| *~', $value);

        if (count($constants) > 1) {
            // this is a list of constants separated by "|", verifies they are all defined constants
            $is_constant = $this->is_constants($constants);

        } else if (defined($value)) {
            $is_constant = true;

        } else  {
            $is_constant = false;

        }

        return $is_constant;
    }

    function is_constants($constants)
    {
        foreach ($constants as $constant) {
            if (! defined($constant)) {
                return false;
            }
        }

        return true;
    }
}
