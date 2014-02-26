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
 * output formatting for display
 */

class output extends object
{
    function display_duration()
    {
        $duration = (microtime(true) - $this->start_time);

        // rounds the duration to one digit
        $rounded = (float)round($duration, 1) or
        $rounded = (float)round($duration, 2) or
        $rounded = (float)round($duration, 3) or
        $rounded = (float)round($duration, 4) or
        $rounded = (float)round($duration, 5) or
        $rounded = (float)round($duration, 6);

       return $rounded;
    }

    function display_error_code($code)
    {
        $messages = [
            E_ERROR        => $this->_translation->translate('PHP error'),
            E_NOTICE       => $this->_translation->translate('PHP notice'),
            E_USER_ERROR   => $this->_translation->translate('PHPbEx error'),
            E_USER_NOTICE  => $this->_translation->translate('PHPbEx notice'),
            E_USER_WARNING => $this->_translation->translate('PHPbEx warning'),
            E_WARNING      => $this->_translation->translate('PHP warning'),
        ];

        $message = isset($messages[$code]) ? $messages[$code] : $this->_translation->translate('Error');

        return $message;
    }

    function display_example_value($key, $value)
    {
        $value = $this->_examples->convert_example_to_text($value, true);

        if (is_numeric($key)) {
            // this is a function argument, appends the arg separator
            $value .= ',';

        } else {
            // this is not a function argument, eg "filename" passed to fopen() before fread()
            // removes the underscores prefixing a var name
            $key = ltrim($key, '_');
            // comments both param name and value
            $value = sprintf('/* $%s = %s */', $key, $value);
        }

        return $value;
    }

    function display_example_values($example)
    {
        if (is_null($example)) {
            $example = [null];
        } else  {
            $example = (array) $example;
        }

        foreach ($example as $key => &$value) {
            $value = $this->display_example_value($key, $value);
        }

        // adds line breaks between example values with spaces for left justification
        $values = implode("\n  ", $example);
        // trims the separator after the last value
        $values = rtrim($values, ',');
        // encloses the values between parenthesis as in a function call
        $values = sprintf('<?php (%s)',$values);
        // removes extra spaces
        $values = preg_replace('~  +~', ' ', $values);
        // removes the last comma before the end of an array
        $values = preg_replace('~ *, *]~', ' ]', $values);

        $html = $this->highlight_source_code_piece($values, false);

        return $html;
    }

    function display_function_list($functions, $title, $color)
    {
        require __DIR__ . '/../views/listed_functions.phtml';
    }

    function display_function_manual_page_url()
    {
        if ($this->_params->php_manual_location == 'php.net') {
            // displays the official php.net manual page
            $function_manual_page_url = sprintf('http://php.net/manual/%s.php', $this->_synopsis->manual_function_name);

        } else if (file_exists(sprintf('%s/manual/%s/%s.html', $this->public_path, $this->_language->language_id, $this->_synopsis->manual_function_name))) {
            // displays the local manual function page
            $function_manual_page_url = sprintf('%s/manual/%s/%s.html', $this->base_url, $this->_language->language_id, $this->_synopsis->manual_function_name);

        } else if (file_exists(sprintf('%s/manual/%s/index.html', $this->public_path, $this->_language->language_id))) {
            // this function is not in the manual, defaults to the local manual index page
            $function_manual_page_url = sprintf('%s/manual/%s', $this->base_url, $this->_language->language_id);

        } else {
            $function_manual_page_url = null;
        }

        return $function_manual_page_url;
    }

    function display_function_name()
    {
        $function_name = $this->_synopsis->function_name . ' ()';

        return $function_name;
    }

    function display_function_title()
    {
        $prev_function_name = $this->_function_list->get_function_name_around(-1);
        $next_function_name = $this->_function_list->get_function_name_around(+1);
        require __DIR__ . '/../views/function_title.phtml';
    }

    function display_tested_function_list($functions, $title, $color, $test_count_by_function = null, $test_subset_count_by_function = null)
    {
        require __DIR__ . '/../views/tested_functions.phtml';
    }

    function display_url($action = null, $function_name = null)
    {
        if ($function_name) {
            // there is a function name, eg "http://php-by-example/en/function/abs"
            $url = sprintf('%s/%s/%s/%s', $this->base_url, $this->_language->language_id, $action, $function_name);

        } else if ($action) {
            if ($action == 'test') {
                // test all functions, adds suffix to action, eg "test_all"
                $action .= '_all';
            }

            // eg "http://php-by-example/en/help"
            $url = sprintf('%s/%s/%s', $this->base_url, $this->_language->language_id, $action);

        } else {
            // this is the home page, eg "http://php-by-example/en"
            $url = sprintf('%s/%s', $this->base_url, $this->_language->language_id);
        }

        return $url;
    }

    function display_var_value($value)
    {
        $string = $this->export_var_value($value);
        $html = $this->highlight_source_code_piece($string);

        return $html;
    }

    function export_var_value($value)
    {
        $value = $this->_converter->convert_resource_to_text($value);
        $string = '<?php ' . var_export($value, true) . ';';

        // converts "array(...)" to "[...]"
        $string = str_replace('<?php array (', '<?php [', $string);
        $string = preg_replace('~[\n] +array \(~', '[', $string);
        $string = str_replace('),', '],', $string);
        $string = str_replace(');', '];', $string);

        return $string;
    }

    function highlight_pattern_in_function_name($function_name, $pattern)
    {
        $function_name = preg_replace("~$pattern~i", "<b>$0</b>", $function_name, 1);

        return $function_name;
    }

    function highlight_source_code_piece($string, $trim_extra_left_spaces = true)
    {
        $html = highlight_string($string, true);
        // removes the php tag
        $html = preg_replace('~&lt;\?php~', '', $html, 1);

        if ($trim_extra_left_spaces) {
            // removes the extra left spaces
            $html = preg_replace('~&nbsp;~', '', $html, 1);
        }

        // removes ";" after end of the array used to make the var_export()
        $html = preg_replace('~;</span>\s</span>\s</code>$~', '</span></span></code>', $html);

        return $html;
    }
}
