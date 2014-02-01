<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class converter extends object
{
    function convert_array_to_text($value, $no_linebreak = false)
    {
        $value = var_export($value, true);
        $value = preg_replace('~array \(~', '[', $value);
        $value = str_replace('),', '],', $value);
        $value = preg_replace('~\)$~', ']', $value);

        if ($no_linebreak) {
            $value = str_replace("\n", '', $value);
        }

        return $value;
    }
    function convert_resource_to_text($value)
    {
        if (is_array($value)) {
            $value = array_map([$this, 'convert_resource_to_text'], $value);

        } else if (is_resource($value)) {
            $value = get_resource_type($value);
        }

        return $value;
    }

    function convert_string_to_text($value, $no_linebreak, $force_quotes = false)
    {
        if ($this->_params->is_param_var($value) or $this->is_constant($value)) {
            if ($force_quotes) {
                $value = "'$value'";
            }

        } else {
            if ($no_linebreak) {
                // replaces line breaks with a space character
                $value = str_replace(["\r\n", "\n", "\r"], ' ', $value);
            }

            if (strpos($value, '$') !== false or preg_match('~^([^a-z0-9\ ]).+\1[a-z]*$~is', $value)) {
                // there are "$" in the string (1) or this is (most likely) a regex pattern (2), encloses the string with single quotes
                // note (1) that parser::get_next_token() would not return a T_STRING if it was enclosed with double quotes
                // note (2) that backslashes would be difficult to handle properly to create a pattern between double quotes with the expected behaviour
                // see http://fr2.php.net/manual/en/regexp.reference.delimiters.php on regex pattern delimiters
                // note that linebreaks, tabs etc. will not be replaced by their string equivalent which is acceptable
                $value = "'" . str_replace("'", "\'", $value) . "'";

            } else {
                // see http://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double
                // escapes back slashes and double quotes
                $value = str_replace(['\\', '"'], ['\\\\', '\"'], $value);
                // replaces linebreaks, tabs etc. their string equivalent
                $value = str_replace(["\n", "\r", "\t", "\v", "\e", "\f"], ['\n', '\r', '\t', '\v', '\e', '\f'], $value);
                // encloses the string with double quotes
                $value = '"' . $value . '"';
            }
        }

        return $value;
    }

    function convert_value_to_text($value, $no_linebreak = false, $force_quotes = false)
    {
        $type = gettype($value);

        switch($type) {
            case 'array':
                $value = $this->convert_array_to_text($value, $no_linebreak);
                break;

            case 'boolean':
                $value = $value? 'true' : 'false';
                break;

            case 'double':
            case 'float':
            case 'integer':
                break;

            case 'null':
            case 'NULL':
                $value = 'null';
                break;

            case 'string':
                $value = $this->convert_string_to_text($value, $no_linebreak, $force_quotes);
                break;

            default:
                throw new Exception("unexpected example value with type: $type");
        }

        return $value;
    }

    function is_constant($value)
    {
        $constants = preg_split('~ *\| *~', $value);

        if (count($constants) > 1) {
            // this is a list of constants
            $is_constant = $this->is_constants($constants);

        } else if (in_array($value, ['null', 'false', 'true', 'NULL', 'FALSE', 'TRUE'], true)) {
            $is_constant = false;

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
