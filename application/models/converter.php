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

    function convert_string_to_text($value, $no_linebreak, $force_quotes = false)
    {
        if ($this->_params->is_param_var($value) or $this->is_constants($value)) {
            if ($force_quotes) {
                $value = "'$value'";
            }

        } else {
            if ($no_linebreak) {
                $value = str_replace("\n", ' ', $value);
            }

            if (strpos($value, '$') !== false or strpos($value, '\\') !== false) {
                // there are "$" in the string, or eg '\n' not to be converted to a linebreak etc., encloses the string with single quotes
                // note that the parser would not return a T_STRING if it was enclosed with double quotes
                // note that linebreaks and tabs will not be replaced by their string equivalent which is acceptable
                $value = "'" . str_replace("'", "\'", $value) . "'";
            } else {
                // encloses the string with double quotes
                // escapes double quotes, replaces linebreaks and tabs with their string equivalent
                $value = '"' . str_replace(['"', "\n", "\r", "\t"], ['\"', '\n', '\r', '\t'], $value) . '"';
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

    function is_constants($value)
    {
        $constants = preg_split('~ *\| *~', $value);

        foreach ($constants as $constant) {
            if (! defined($constant)) {
                return false;
            }
        }

        return true;
    }
}
