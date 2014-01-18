<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class parser extends object
{
    function add_error_details()
    {
        if (! $unparsed_tokens = $this->get_unparsed_tokens()) {
            $error_details = null;

        } else {
            $error_details = ": $unparsed_tokens";
        }

        return $error_details;
    }

    function get_all_tokens($value)
    {
        $this->tokens = token_get_all('<?php ' . $value);
        array_shift($this->tokens);
        $this->current = 0;
    }

    function get_next_token()
    {
        while(isset($this->tokens[$this->current]) and $token = $this->tokens[$this->current]) {
            $this->current++;

            if (is_array($token) and $token[0] == T_WHITESPACE) {
                // skips spaces
                continue;
            }

            return $this->parse_token($token);
        }

        // no token left to parse
        return '_NO_TOKEN_';
    }

    function get_unparsed_tokens()
    {
        $unparsed_tokens = array_slice($this->tokens, --$this->current, 10);

        foreach($unparsed_tokens as &$unparsed_token) {
            if (is_array($unparsed_token)) {
                // gets token value
                $unparsed_token = $unparsed_token[1];
            }
        }

        $unparsed_tokens = implode('', $unparsed_tokens);

        return $unparsed_tokens;
    }

    function parse_array($token = null)
    {
        if (is_null($token)) {
            $token = $this->get_next_token();
        }

        if ($token !== '_BEGIN_') {
            throw new Exception($this->_translation->translate('invalid array'));
        }

        $array = [];
        $expecting = '_KEY_||_VALUE_||_END_';

        while(true) {
            $token = $this->get_next_token();

            switch($expecting) {
                case '_KEY_||_VALUE_||_END_':
                    if ($token === '_END_') {
                        return $array;

                    } else if ($token === '_BEGIN_' or $token === '_ARROW_' or $token === '_SEPARATOR_') {
                        throw new Exception($this->_translation->translate('invalid array'));

                    } else {
                        $array[] = $token;
                        $expecting = is_array($token)? '_SEPARATOR_||_END_' : '_ARROW_||_SEPARATOR_||_END_';
                    }
                    break;

                case '_SEPARATOR_||_END_':
                    if ($token === '_SEPARATOR_') {
                        $expecting = '_KEY_||_VALUE_||_END_';

                    } else if ($token === '_END_') {
                        return $array;

                    } else {
                        throw new Exception($this->_translation->translate('invalid array'));
                    }
                    break;

                case '_ARROW_||_SEPARATOR_||_END_':
                    if ($token === '_ARROW_') {
                        // last token was actually a key, pops last value and saves as key
                        $key = array_pop($array);
                        $expecting = '_VALUE_';

                    } else if ($token === '_SEPARATOR_') {
                        $expecting = '_KEY_||_VALUE_||_END_';

                    } else if ($token === '_END_') {
                        return $array;

                    } else {
                        throw new Exception($this->_translation->translate('invalid array'));
                    }
                    break;

                case '_VALUE_':
                    if ($token === '_BEGIN_' or $token === '_ARROW_' or $token === '_SEPARATOR_' or $token === '_END_') {
                        throw new Exception($this->_translation->translate('invalid array'));

                    } else {
                        $array[$key] = $token;
                        $expecting = '_SEPARATOR_||_END_';
                    }
                    break;
            }
        }

        throw new Exception($this->_translation->translate('invalid array'));
    }

    function parse_constants($value)
    {
        if (! defined($value)) {
            // the constant is undefined, eg "xyz"
            throw new Exception($this->_translation->translate('undefined constant'));
        }

        $this->int = constant($value);

        while (true) {
            $token = $this->get_next_token();

            if ($token == '_NO_TOKEN_') {
                // there is no more tokens
                break;
            }

            if ($token != '_OR_') {
                // there is no more constants, this is possible within an array, restores the token
                $this->current--;
                break;
            }

            @list($type, $value) = $this->get_next_token();

            if ($type != T_STRING) {
                // this is not a constant, eg "E_ERROR|123"
                throw new Exception($this->_translation->translate('invalid constant'));
            }

            if (! defined($value)) {
                throw new Exception($this->_translation->translate('undefined constant'));
            }

            $this->int |= constant($value);
        }

        $int = $this->int;
        unset($this->int);

        return $int;
    }

    function parse_negative_number()
    {
        $token = $this->get_next_token();

        if (! is_numeric($token)) {
            // this is not a negative number, eg "-'sdf'"
            throw new Exception($this->_translation->translate('invalid negative number'));
        }

        return $token * -1;
    }

    function parse_string($string)
    {
        $quote = $string[0];
        // removes enclosing quotes
        $string = substr($string, 1, -1);
        // protects double backslashes
        $string = str_replace('\\\\', '_DOUBLE_BACKSLASH_', $string);
        // unescapes embedded quotes
        $string = str_replace('\\' . $quote, $quote, $string);

        if ($quote == '"') {
            // replaces line breaks and tabs
            $string = str_replace('\n', "\n", $string);
            $string = str_replace('\r', "\r", $string);
            $string = str_replace('\t', "\t", $string);
        }

        // restores double backslashes
        $string = str_replace('_DOUBLE_BACKSLASH_', '\\\\', $string);

        return $string;
    }

    function parse_token($token)
    {
        if (is_array($token)) {
            // this is a token with its type and value
            $type = $token[0];
            $value = &$token[1];
        } else {
            // this is a symbol
            $type = $token;
        }

        switch($type) {
            case ',':
                $value = '_SEPARATOR_';
                break;

            case '-':
                $value = $this->parse_negative_number();
                break;

            case '(':
                $value = '_BEGIN_';
                break;

            case ')':
            case ']':
                $value = '_END_';
                break;

            case '|':
                $value = '_OR_';
                break;

            case '[':
                $value = $this->parse_array('_BEGIN_');
                break;

            case T_ARRAY:
                $value = $this->parse_array();
                break;

            case T_CONSTANT_ENCAPSED_STRING:
                $value = $this->parse_string($value);
                break;

            case T_DNUMBER:
                $value = (float) $value;
                break;

            case T_DOUBLE_ARROW:
                $value = '_ARROW_';
                break;

            case T_LNUMBER:
                $value = (int) $value;
                break;

            case T_STRING:
                if ($value === null or $value === false or $value === true) {
                    // the value is null or a boolean, do nothing
                } else if (isset($this->int)) {
                    // this is a list of constants being parsed
                    $value = [T_STRING, $value];
                } else {
                    // this is a single constant or the first constant of a list of or'ed constants
                    $value = $this->parse_constants($value);
                }
                break;

            case T_VARIABLE:
                break;

            default:
                // any other token is rejected, eg "--123", "__DIR__"
                throw new Exception($this->_translation->translate('invalid value'));
        }

        return $value;
    }

    /**
     * the parser entry point
     */
    function parse_value($value, $name)
    {
        try {
            $this->get_all_tokens($value);
            $mixed = $this->get_next_token();

            if ($this->get_next_token() !== '_NO_TOKEN_') {
                // any data is unexpected beyond this point
                throw new Exception($this->_translation->translate('unexpected data'));
            }

        } catch (Exception $e) {
            $message = sprintf('%s ($%s%s)', $e->getMessage(), $name, $this->add_error_details());
            throw new Exception($message, E_USER_ERROR);
        }

        return $mixed;
    }
}