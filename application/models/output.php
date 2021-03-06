<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'object.php';

/**
 * output formatting for display
 */

class output extends object
{
    function _get_manual_function_name()
    {
        if ($this->_function->manual_function_name) {
            $function_name = $this->_function->manual_function_name;
        } else {
            $function_name = $this->_application->function_name;
        }

        $function_name = strtolower($function_name);

        if (strpos($function_name, '::')) {
            // this is a class method, replaces "::" with "."
            $manual_function_name = str_replace('::', '.', $function_name);
        } else {
            // this is a function, prepends the function name with "function."
            $manual_function_name = "function.$function_name";
        }

        $manual_function_name = str_replace('_', '-', $manual_function_name);

        return $manual_function_name;
    }

    function add_link_to_internal_doc($string, $doc_basename)
    {
        $href = $this->_output->display_url('doc', $doc_basename);
        $doc_filename = "docs/$doc_basename.txt";
        $link = sprintf('<a href="%s">%s</a>', $href, $doc_filename);
        $string = str_replace($doc_filename, $link, $string);

        return $string;
    }

    function display_custom_function_title($function_name, $filename, $type)
    {
        if ($type == 'function') {
            $title = sprintf('%s() -- a custom function in %s', $function_name, $filename);

        } else if ($type == 'class') {
            $title = sprintf('%s -- a custom class in %s', $function_name, $filename);

        } else {
            $title = 'Custom function';
        }

        return $title;
    }

    function display_date($date)
    {
        list($date) = explode(' ', $date);

        return $date;
    }

    function display_duration()
    {
        $duration = (microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]);

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
            E_ERROR        => $this->_message_translation->translate('PHP error'),
            E_NOTICE       => $this->_message_translation->translate('PHP notice'),
            E_USER_ERROR   => $this->_message_translation->translate('PBX error'),
            E_USER_NOTICE  => $this->_message_translation->translate('PBX notice'),
            E_USER_WARNING => $this->_message_translation->translate('PBX warning'),
            E_WARNING      => $this->_message_translation->translate('PHP warning'),
        ];

        if (isset($messages[$code])) {
            $message = $messages[$code];
        } else {
            // this is an internal exception without an error code, see function_core.php
            $message = $this->_message_translation->translate('Error');
        }

        return $message;
    }

    function display_example_value($key, $value)
    {
        if (is_numeric($key)) {
            // this is a function argument, gets the arg name
            $arg_name = $this->_synopsis->get_arg_name($key);

        } else {
            $arg_name = $key;
        }

        $value = $this->_examples->convert_example_to_text($value, true, $arg_name);

        if (is_numeric($key)) {
            // this is a function argument, appends the arg separator
            $value .= ',';

        } else {
            // this is not a function argument, eg "filename" passed to fopen() before fread()
            // removes the underscores prefixing a var name
            $key = ltrim($key, '_');
            // comments both var name and value
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
        $functions = array_values($functions);
        $last_index = count($functions) - 1;
        require __DIR__ . '/../views/listed_functions.phtml';
    }

    function display_function_manual_page_url()
    {
        if ($this->_params->php_manual_location == 'php.net') {
            // displays the official php.net manual page
            $function_manual_page_url = sprintf('http://php.net/manual/%s.php', $this->manual_function_name);

        } else if (file_exists(sprintf('%s/manual/%s/%s.html', $this->public_path, $this->_language->language_id, $this->manual_function_name))) {
            // displays the local manual function page
            $function_manual_page_url = sprintf('%s/manual/%s/%s.html', $this->base_url, $this->_language->language_id, $this->manual_function_name);

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
        $function_name = $this->_application->function_name . '()';

        return $function_name;
    }

    function display_function_title()
    {
        $prev_function_name = $this->_function_list->get_function_name_around(-1);
        $next_function_name = $this->_function_list->get_function_name_around(+1);
        require __DIR__ . '/../views/function_title.phtml';
    }

    function display_log_entry_text($text)
    {
        $text = str_replace('\n', '<br />', $text);

        return htmlspecialchars($text);
    }

    function display_mailto($subject, $body)
    {
        $subject = urlencode($subject);
        $body = urlencode($body);
        $mailto = sprintf('mailto:help.php.by.example@gmail.com?subject=[PHP-by-Example]+%s&body=%s', $subject, $body);

        return $mailto;
    }

    function display_tested_items_list($action, $items, $title, $color, $tests_counts = null, $tests_sub_counts = null)
    {
        $last_item_name = end($items);
        require __DIR__ . '/../views/tested_items_list.phtml';
    }

    function display_translation_selection($selected_message_id, $messages)
    {
        require __DIR__ . '/../views/translation_selection.phtml';
    }

    function display_translator_name($email, $obfuscate)
    {
        if ($obfuscate) {
            $translator_name =  $email[0] . '*******';

        } else {
            list($translator_name) = explode('@', $email, 2);
        }

        return $translator_name;
    }

    function display_url($action = null, $function_name = null, $parameters = null, $language_id = null)
    {
        if (! $language_id) {
            $language_id = $this->_language->language_id;
        }

        if ($function_name) {
            // there is a function name, eg "http://php-by-example/en/function/abs"
            $url = sprintf('%s/%s/%s/%s', $this->base_url, $language_id, $action, $function_name);

        } else if ($action) {
            // eg "http://php-by-example/en/help"
            $url = sprintf('%s/%s/%s', $this->base_url, $language_id, $action);

        } else {
            // this is the home page, eg "http://php-by-example/en"
            $url = sprintf('%s/%s', $this->base_url, $language_id);
        }

        if ($parameters) {
            $url .= $parameters;
        }

        return $url;
    }

    function display_var_value($value, $fix_exported_array = true)
    {
        $string = $this->export_var_value($value, $fix_exported_array);
        $html = $this->highlight_source_code_piece($string);

        return $html;
    }

    function export_var_value($value, $fix_exported_array = true)
    {
        $text = $this->_converter->convert_var_to_text($value);
        $string = '<?php ' . var_export($text, true) . ';';

        if ($value instanceof stdClass) {
            $string = str_replace('stdClass::__set_state(array(', '(object) [', $string);
            $string = preg_replace('~\)\);$~', '];', $string);

        } elseif ($fix_exported_array) {
            // converts "array(...)" to "[...]"
            $string = str_replace('<?php array (', '<?php [', $string);
            $string = preg_replace('~[\n] +array \(~', '[', $string);
            $string = str_replace('),', '],', $string);
            $string = str_replace(');', '];', $string);
        }

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

    function remove_email_address($content)
    {
        $content = preg_replace('~(<|&lt;)?[\w.-]+@[\w.]+(>|&gt;)?~', '', $content);

        return $content;
    }
}
