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
 * function input form generation
 * entry point: display_source_code()
 */

class input extends object
{
    const CHARACTER_COUNT_BY_EM = 1.5; // about 30 characters for a 20em line
    const INPUT_WIDTH_IN_EM     = 20;  // must be the same as CSS textarea.arg width
    const LINE_HEIGHT_IN_EM     = 1.2;

    function _get_double_slash()
    {
        if (! $color = ini_get('highlight.comment')) {
            $color = '#FF8000'; // orange
        }

        $double_slash = sprintf('<span style="color: %s">//</span>', $color);

        return $double_slash;
    }

    function calculate_input_height($arg_value)
    {
        $lines = explode("\n", $arg_value);
        $line_count = count($lines);
        $max_characters_by_line = self::CHARACTER_COUNT_BY_EM * self::INPUT_WIDTH_IN_EM;

        foreach ($lines as $line) {
            $line = wordwrap($line, $max_characters_by_line, "\n", true);
            $line_count += substr_count($line, "\n");
        }

        $height = self::LINE_HEIGHT_IN_EM * ($line_count ?: 1);

        return $height;
    }

    function display_arg($arg_type, $arg_name)
    {
        $format = '<textarea
                     class="arg %1$s"
                     id="textarea_%2$s"
                     name="%2$s" style="height: %3$sem"
                   >%4$s</textarea>';

        if (in_array($arg_name, (array) $this->_function->no_input_args) or ! $this->_synopsis->is_input_arg($arg_name) and ! in_array($arg_name, (array) $this->_function->input_args)) {
            // this is an arg that is not meant to be changed by the user, forces the html class of the arg to no_imput (gray color etc.)
            $arg_type = 'no_input';
        }

        $arg_value = $this->_function_params->param_exists($arg_name) ? $this->_function_params->params[$arg_name] : null;
        $height = $this->calculate_input_height($arg_value);

        $arg_value = htmlspecialchars($arg_value);
        $html = sprintf($format, $arg_type, $arg_name, $height, $arg_value);

        return $html;
    }

    function display_arg_helper($arg_type, $arg_name)
    {
        $multi_select = isset($this->_function->multi_select[$arg_name]) ? $this->_function->multi_select[$arg_name] : null;

        if (isset($this->_function->options_getter[$arg_name])) {
            $arg_helper_options = $this->get_helper_options_from_getter($this->_function->options_getter[$arg_name]);
            $indexed_options = true;

        } else if (isset($this->_function->options_list[$arg_name])) {
            $arg_helper_options = $this->enclose_indexed_options_with_quotes($this->_function->options_list[$arg_name]);
            $indexed_options = true;

        } else if (isset($this->_function->options_range[$arg_name])) {
            $arg_helper_options = $this->get_helper_options_from_range($this->_function->options_range[$arg_name]);
            $indexed_options = true;

        } else if (isset($this->_function->commented_options[$arg_name])) {
            $arg_helper_options = $this->format_commented_options($this->_function->commented_options[$arg_name]);
            $indexed_options = false;

        } else if ($constant_prefix = $this->_synopsis->is_boolean_arg($arg_name)) {
            $arg_helper_options = ['false', 'true'];
            $indexed_options = true;
            $multi_select = false;

        } else if ($constant_prefix = $this->_synopsis->get_arg_constant_name_prefix($arg_name)) {
            $indexed_options = true;
            $arg_helper_options = $this->_synopsis->get_arg_constant_names($constant_prefix);

        } else if ($arg_type == 'callable') {
            $arg_helper_options = $this->get_helper_callbacks();
            $indexed_options = true;

        } else {
            return null;
        }

        $html = $this->display_arg_helper_select($arg_name, $arg_helper_options, $arg_type, $multi_select, $indexed_options);
        $html .= $this->display_arg_helper_mark($arg_name);

        return $html;
    }

    function display_arg_helper_assoc_options($arg_helper_options)
    {
        $options = '';

        foreach ($arg_helper_options as $text => $value) {
            $text = htmlspecialchars($text);
            $text = str_replace(' ', '&nbsp;', $text);
            $value = htmlspecialchars($value);
            $options .= "<option value=\"$value\">$text</option>";
        }

        return $options;
    }

    function display_arg_helper_indexed_options($arg_helper_options)
    {
        $options = '';

        foreach ($arg_helper_options as $option) {
            $option = htmlspecialchars($option);
            $options .= "<option>$option</option>";
        }

        return $options;
    }

    function display_arg_helper_mark($arg_name)
    {
        $format = '<span
                     class="helper_mark"
                     id="helper_mark_%1$s"
                     onclick="display_arg_helper_select(\'%s\')"
                   >?</span>';

        $helper_mark = sprintf($format, $arg_name);

        return $helper_mark;
    }

    function display_arg_helper_select($arg_name, $arg_helper_options, $arg_type, $multi_select = false, $indexed_options = true)
    {
        if ($multi_select === true or $multi_select === null and substr($arg_name, -1) == 's' and substr($arg_name, -2) != 'ss') {
            // this is a multi-select or the arg name is plural and the ending is different from "ss" as in "class", displays a multi-select
            $empty_option = '-- ' . $this->_message_translation->translate('multi-select') . ' --';

            $format = '<select
                         class="helper %3$s"
                         id="select_%1$s"
                         multiple
                       >%2$s</select>';

        } else {
            // this is a single select
            $empty_option = null;

            $format = '<select
                         class="helper %3$s"
                         id="select_%1$s"
                         onchange="set_arg_value(\'%1$s\')"
                       >%2$s</select>';
        }

        // the separation between the select and the span of the checkmark must not be removed for alignment purposes
        $format .= "\n";
        $format .= '<span
                     class="helper_submit"
                     id="helper_submit_%1$s"
                     onclick="set_arg_value(\'%1$s\')"
                   >✓</span>';

        $options = "<option value=''>$empty_option</option>";

        if ($indexed_options) {
            $options .= $this->display_arg_helper_indexed_options($arg_helper_options);
        } else {
            $options .= $this->display_arg_helper_assoc_options($arg_helper_options);
        }

        $helper_select = sprintf($format, $arg_name, $options, $arg_type);

        return $helper_select;
    }

    function display_args()
    {
        $last_index = count($this->_synopsis->arg_names) - 1;
        $args = '';

        foreach ($this->_synopsis->arg_names as $index => $arg_name) {
            $comma = $index == $last_index ? ' ' : ',';
            $args .= sprintf("\n    $%s%s // %s", $arg_name, $comma, $this->_synopsis->arg_descriptions[$index]);
        }

        if ($args) {
            $args .= "\n";
        }

        return $args;
    }

    function display_function_call()
    {
        $function_call = '';

        if ($this->_synopsis->return_var) {
            // the return var is prefixed with "_" so it is not mistaken with an input var, see replace_vars_by_inputs()
            $function_call .= sprintf('$_%s = ', $this->_synopsis->return_var);
        }

        $function_call .= $this->_synopsis->method_name . ' ('. $this->display_args() . ');';

        return $function_call;
    }

    function display_method_name($highlighted_code)
    {
        $format = '<span class="method_name">%s</span>';
        $html = sprintf($format, $this->_synopsis->method_name);
        $highlighted_code = preg_replace("~\b{$this->_synopsis->method_name}\b~", $html, $highlighted_code, 1);

        return $highlighted_code;
    }

    function display_changeable_vars($highlighted_code)
    {
        if (! preg_match_all('~CHANGEABLE_VAR_(\w+)~', $highlighted_code, $matches, PREG_SET_ORDER)) {
            return $highlighted_code;
        }

        foreach ($matches as $match) {
            list($prefixed_var_name, $var_name) = $match;
            $html = $this->display_arg('var', $var_name);
            $html .= $this->display_arg_helper('var', $var_name);
            $highlighted_code = str_replace($prefixed_var_name, $html, $highlighted_code);
        }

        return $highlighted_code;
    }

    function display_source_code()
    {
        $source_code = $this->inject_function_call();
        $vars_to_replace = $this->get_vars_to_replace_by_inputs($source_code);
        $source_code = "<?php\n" . trim($source_code) . "\n?>";

        $highlighted_code = highlight_string($source_code, true);
        $highlighted_code = $this->replace_vars_by_inputs($highlighted_code, $vars_to_replace);
        $highlighted_code = $this->display_method_name($highlighted_code);

        // adds a double slash before commented functions
        $highlighted_code = str_replace('_DOUBLE_SLASH_', $this->double_slash, $highlighted_code);
        $highlighted_code = $this->display_changeable_vars($highlighted_code);

        return $highlighted_code;
    }

    function enclose_indexed_options_with_quotes($options)
    {
        foreach ($options as &$option) {
            if (is_string($option) and $option[0] != '$') {
                $option = '"' . $option . '"';
            }
        }

        sort($options, SORT_NATURAL | SORT_FLAG_CASE);

        return $options;
    }

    function format_commented_options($commented_options)
    {
        $formatted = [];

        foreach ($commented_options as $commented_option) {
            list($value, $comment) = $commented_option;

            if (is_string($value)) {
                $value = '"' . $value . '"';
            }

            if ($comment[0] == ' ') {
                $comment = preg_replace('~^( +)~', '$1 // ', $comment);
            } else {
                $comment = " // $comment";
            }

            $text = $value . $comment;
            $formatted[$text] = $value;
        }

        ksort($formatted, SORT_NATURAL | SORT_FLAG_CASE);

        return $formatted;
    }

    function get_callback_in_example($callback)
    {
        if (is_array($callback)) {
            $class_name = current($callback);
            $method_name = next($callback);

            if ($class_name[0] == '$') {
                $callback = sprintf('[%s, "%s"]', $class_name, $method_name);
            } else {
                $callback = sprintf('["%s", "%s"]', $class_name, $method_name);
            }

        } else if ($callback[0] != '$') {
            $callback = '"' . $callback . '"';
        }

        return $callback;
    }

    function get_callbacks_in_examples($callback_index)
    {
        $callbacks_in_examples = [];

        foreach ($this->_function->examples as $example) {
            if (isset($example[$callback_index]) and $example[$callback_index]) {
                $callback = $example[$callback_index];
                $callbacks_in_examples[] = $this->get_callback_in_example($callback);
            }
        }

        return $callbacks_in_examples;
    }

    function get_defined_function_callbacks($defined_functions_pattern)
    {
        $defined_functions = get_defined_functions();
        $defined_function_callbacks = preg_grep($defined_functions_pattern, $defined_functions['internal']);

        foreach ($defined_function_callbacks as &$defined_callback) {
            $defined_callback = '"' . $defined_callback . '"';
        }

        return $defined_function_callbacks;
    }

    function get_helper_callbacks()
    {
        $callbacks = [];

        if (isset($this->_function->helper_callbacks['index_in_example'])) {
            $callbacks_in_examples = $this->get_callbacks_in_examples($this->_function->helper_callbacks['index_in_example']);
            $callbacks = array_merge($callbacks, $callbacks_in_examples);
        }

        if (isset($this->_function->helper_callbacks['function_name_pattern'])) {
            $defined_function_callbacks = $this->get_defined_function_callbacks($this->_function->helper_callbacks['function_name_pattern']);
            $callbacks = array_merge($callbacks, $defined_function_callbacks);
        }

        $callbacks = array_unique($callbacks);
        sort($callbacks);

        return $callbacks;
    }

    function get_helper_options_from_getter($getter_function)
    {
        $options = call_user_func($getter_function);
        $options = $this->enclose_indexed_options_with_quotes($options);

        return $options;
    }

    function get_helper_options_from_range($range)
    {
        list($start, $end) = $range;
        $options = range($start, $end);

        if (is_string($start)) {
            $options = $this->enclose_indexed_options_with_quotes($options);
        }

        return $options;
    }

    function get_vars_to_replace_by_inputs($source_code)
    {
        preg_match_all('~^    \$(\w+)[,;]? +// \[?(array|callable|bool|float|int|mixed|resource|string|DateInterval) &?\$\w+.*$~m', $source_code, $matches, PREG_SET_ORDER);

        return $matches;
    }

    function inject_function_call()
    {
        $function_call = $this->display_function_call();

        if ($this->_function->source_code) {
            // the function has some specific source code to display, eg "functions/datetime__add.php"
            // removes the extra leading spaces used for alignement purposes in the class definition
            $source_code = preg_replace('~^        ~m', '', $this->_function->source_code);
            // inject the funcion call in the source code
            $source_code = str_replace('inject_function_call', $function_call, $source_code);
        } else {
            // the function has no specific source code to display, eg 'functions/abs.php"
            // uses the function call as the source code
            $source_code = $function_call;
        }

        // prefixes the additional params to get a proper line break, eg "    $mode; // string $mode"
        $source_code = preg_replace('~^\n    \$\w+; // ~m', '_ARG_LINE_BREAK_$0', $source_code);

        return $source_code;
    }

    function replace_var_by_input($highlighted_code, $var_to_replace)
    {
        list(, $var_name, $var_type) = $var_to_replace;

        $input = $this->display_arg($var_type, $var_name);
        $input .= $this->display_arg_helper($var_type, $var_name);

        // escapes "$" so it is not used as replacement backreferences, eg "$123"
        $input = str_replace('$', '\$', $input);
        // protects characters in octal notation so they are not used as replacement backreference, eg "\061"
        $input = preg_replace('~\\\\([0-7]{1,3})~', '_BACKSLASH_' . '$1', $input);

        $highlighted_code = preg_replace("~\\$$var_name\b~", $input, $highlighted_code, 1);

        // restores the backslash of characters in octal notation
        $highlighted_code = str_replace('_BACKSLASH_', '\\', $highlighted_code);

        return $highlighted_code;
    }

    function replace_vars_by_inputs($highlighted_code, $vars_to_replace)
    {
        foreach ($vars_to_replace as $var_to_replace) {
            $highlighted_code = $this->replace_var_by_input($highlighted_code, $var_to_replace);
        }

        // removes "_" used to prefix var names not be replaced by a textarea, eg "$_filename"
        $highlighted_code = preg_replace('~\$_+~', '$', $highlighted_code);
        // replaces html line breaks by resizable empty div's
        $highlighted_code = preg_replace('~_ARG_LINE_BREAK_<br />~', '<div class="linebreak">&nbsp;</div>', $highlighted_code);

        return $highlighted_code;
    }
}
