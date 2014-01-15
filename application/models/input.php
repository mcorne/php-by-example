<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

class input extends object
{
    const CHARACTER_COUNT_BY_EM = 1.6;
    const EM_BY_LINE_COUNT      = 1.7;
    const INPUT_WIDTH_IN_EM     = 20;

    public $sizes = [ // in em
        'flags'      => 2.5,
        'sort_flags' => 2.5,
    ];

    function calculate_input_height($value, $name)
    {
        $lines = explode("\n", $value);
        $line_count = 0;

        foreach ($lines as $line) {
            $line_count += ceil(strlen($line) / (self::INPUT_WIDTH_IN_EM * self::CHARACTER_COUNT_BY_EM));
        }

        if ($line_count > 1) {
            $height = self::EM_BY_LINE_COUNT * $line_count;
        } else {
            $height = $line_count;
        }

        // TODO: use the arg type and defaults to 3 for arrays, fix the height that tends to be oversized
        $min_input_height = isset($this->sizes[$name]) ? $this->sizes[$name] : 1;

        if ($height < $min_input_height) {
            $height = $min_input_height;
        }

        return $height;
    }

    function display_arg($type, $name)
    {
        $format = '<textarea class="arg %s" name="%s" style="height: %sem">%s</textarea>';

        if (in_array($name, (array) $this->no_input_args) or ! $this->_synopsis->is_input_arg($name) and ! in_array($name, (array) $this->input_args)) {
            // this is an arg that is not meant to be changed by the user, forces the html class of the arg to no_imput (gray color etc.)
            $type = 'no_input';
        }

        $value = $this->_params->param_exists($name) ? $this->_params->params[$name] : null;
        $height = $this->calculate_input_height($value, $name);

        $value = htmlspecialchars($value);
        $html = sprintf($format, $type, $name, $height, $value);

        return $html;
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

        $function_call .= $this->_synopsis->method_name . ' (';
        $function_call .= $this->display_args();
        $function_call .= ');';

        return $function_call;
    }

    function display_method_name($highlighted_code)
    {
        $format = '<span class="method_name">%s</span>';
        $html = sprintf($format, $this->_synopsis->method_name);
        $highlighted_code = preg_replace("~{$this->_synopsis->method_name}~", $html, $highlighted_code, 1);

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

        return $highlighted_code;
    }

    function get_vars_to_replace_by_inputs($source_code)
    {
        preg_match_all('~^ +\$(\w+)[,;]? +// \[?(array|callable|bool|int|mixed|resource|string|DateInterval) &?\$\w+.*$~m', $source_code, $matches, PREG_SET_ORDER);

        return $matches;
    }

    function inject_function_call()
    {
        $function_call = $this->display_function_call();

        if ($this->source_code) {
            // the function has some specific source code to display, eg "functions/datetime__add.php"
            // inject the funcion call in the source code
            $source_code = str_replace('inject_function_call', $function_call, $this->source_code);
        } else {
            // the function has no specific source code to display, eg 'functions/abs.php"
            // uses the function call as the source code
            $source_code = $function_call;
        }

        return $source_code;
    }

    function replace_var_by_input($highlighted_code, $var_to_replace)
    {
        list(, $var_name, $var_type) = $var_to_replace;
        $input = $this->display_arg($var_type, $var_name);
        // escapes "$" so it is not used as replacement reference, eg "$123"
        $input = str_replace('$', '\$', $input);
        $highlighted_code = preg_replace("~\\$$var_name\b~", $input, $highlighted_code, 1);

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
        $highlighted_code = preg_replace('~<br />~', '<div class="linebreak">&nbsp;</div>', $highlighted_code);

        return $highlighted_code;
    }
}
