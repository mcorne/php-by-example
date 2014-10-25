<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Convert a text string to html
 *
 * @param  string $text    text to convert
 * @param  array  $tags    tags replacing pbx_text_to_html::$default_tags
 * @param  array  $options options replacing pbx_text_to_html::$default_options
 * @return string text converted to html
 * @see    docs/sample.txt
 */
function pbx_text_to_html($text, array $tags = null, array $options = null)
{
    $text_to_html = new pbx_text_to_html($tags, $options);
    $html = $text_to_html->process_text($text);

    return $html;
}

/**
 * Converts a text string to html
 */

class pbx_text_to_html
{
    public $default_options =
    [
        /*
         * Replacements of emails and urls with "<a>" tags
         */
        'replacements' => [
            'email' => [
                'pattern'     => '~[\w.%_+-]+@[\w.-]+~',
                'replacement' => '<a href="mailto:$0">$0</a>',
            ],

            'http' => [
                'pattern'     => '~https?://([\w.%_+/-]+)~',
                'replacement' => '<a href="$0">$1</a>',
            ],
        ],
    ];

    public $default_tags = [
        /*
         * Title underline or horizontal break
         *
         * a title underline is after a string which is then considered as a title, eg "----------"
         * a horizontal break is after a blank line, see "hr" below
         *
         * the following blank line and preceding blank line are ignored
         *
         * the first two characters only are used to determine the underline type, leading spaces are ignored
         * the key is referred to as the $underline_type or $title_type
         */
        '==' => '<h1 style="color: black; font-size: 1.3em; margin-bottom: 1.5em">',
        '--' => '<h2 style="color: black; font-size: 1.1em; margin-top: 1.5em;">',
        '++' => '<h3>',
        '**' => '<h4>',

        /*
         * Table row separator
         *
         * eg "+-----+-----+" for any data, or "+=====+=====+" for column headers
         * "+=" may be used under the first row of cells for column headers, the cells will be rendered as "<th>"
         * the first two characters are used to determine the row type, leading spaces are ignored
         *
         * the top row separator of a table may start with "+~"
         * a "~" may be used in place of a "-" to indicate the horizontal alignement of text in cells of a given column,
         * the "~" must be after or before a "+", or somewhere in between two "+", eg "+~-------+---~----+-------~+--------+"
         *                                                                            "|left    | center |   right|default |"
         * this applies to data cells only
         * a number in a cell is aligned on the right by default
         *
         * a table may not be inside a cell, doing so will merge cells together
         * a list may be inside a cell but will not be rendered with "<ul>" or "<ol>" tags
         *
         * the key is referred to as the $row_type
         */
        '+-'  =>  [
            'table' => '<table style="border-collapse: collapse; margin-bottom: .8em; margin-top: .2em">',
            'tr'    => '<tr>',
        ],

        /*
         * Table cell separator
         *
         * eg "| 123 | 456 |", the closing "|" is mandatory, leading spaces are ignored
         * a cell may span several lines, eg "| this is in data  |"
         *                                    | in the same cell |"
         * a cell may contain a table which will be rendered as such
         * a list within a table cell will not be rendered with "<ul>" or "<ol>" tags
         * note the use "%s" used by the "text-align" property, see add_table_row()
         */
        '|'  =>  [
            'td' => '<td style="border: 1px solid gray; padding: .2em; vertical-align: top; text-align: %s">',
            'th' => '<th style="border: 1px solid gray; padding: .2em; vertical-align: top">',
        ],

        /*
         * Unordered and ordered lists
         *
         * lists may be embedded, the key is used to differenciate them, leading spaces are ignored
         *
         * note the use the "ul" key including for ordered lists
         *
         * a list item may be broken into several lines excluding blank lines
         * a list item inside a table will be processed as a string and not rendered as a html list
         * a table may be inside a list and will be rendered as such
         *
         * the key is referred to as the $list_type
         */

        /*
         * Unordered list item, eg "- some text..."
         */
        '= ' => ['li' => '<li>', 'ul' => '<ul style="margin-bottom: .8em; margin-top: .2em">'],
        '- ' => ['li' => '<li>', 'ul' => '<ul style="margin-bottom: .8em; margin-top: .2em">'],
        '+ ' => ['li' => '<li>', 'ul' => '<ul style="margin-bottom: .8em; margin-top: .2em">'],
        '* ' => ['li' => '<li>', 'ul' => '<ul style="margin-bottom: .8em; margin-top: .2em">'],

        /*
         * Ordered list item, eg "#1 some text..." or "1. some text..." or "a. some text..."
         */
        '#1'  => ['li' => '<li>', 'ul' => '<ol start="%s" type="%s" style="margin-bottom: .8em; margin-top: .2em">'],
        '#A'  => ['li' => '<li>', 'ul' => '<ol start="%s" type="%s" style="margin-bottom: .8em; margin-top: .2em">'],
        '#a'  => ['li' => '<li>', 'ul' => '<ol start="%s" type="%s" style="margin-bottom: .8em; margin-top: .2em">'],

        /*
         * Blank line
         *
         * ignored at the end of a list or table, or after an underline, or before a title
         */
        'br' => '<br />',

        /*
         * Horizontal line, see title underline above
         */
        'hr' => '<hr />',
    ];

    public $end_tags;

    public $html = [];

    public $is_title = false;

    public $lines;

    public $list_types = [];

    public $options;

    public $ignore_blank_line;

    public $start_tags;

    public $table_cells_alignment;

    public $table_cell_type;

    public $table_cells = [];

    /**
     * Sets tags and options
     *
     * @param array $tags    tags replacing $default_tags
     * @param array $options options replacing $default_options
     */
    function __construct(array $tags = null, array $options = null)
    {
        $this->set_start_tags($tags);
        $this->set_end_tags();
        $this->set_options($options);
    }

    /**
     * Adds a blank line in a multiple-line list item
     *
     * @param array $lines
     * @param int   $index
     */
    function add_blank_line_in_list_item(array $lines, $index)
    {
        if ($this->need_blank_line($lines, $index)) {
            $this->html[] = $this->start_tags['br'];
        }
    }

    /**
     * Adds a line
     *
     * @param string $string
     */
    function add_line($line)
    {
        $this->add_string($line);
        $this->html[] = $this->start_tags['br'];
    }

    /**
     * Adds a list item, eg "</li>abc<li>
     *
     * @param string $list_type eg "- "
     * @param string $list_item
     * @see   $list_type in self::$default_tags
     */
    function add_list_item($list_type, $list_item)
    {
        $this->html[] = $this->end_tags[$list_type]['li'];
        $this->html[] = $this->start_tags[$list_type]['li'];
        $this->add_string($list_item);
    }

    /**
     * Adds a string
     *
     * @param string $string
     */
    function add_string($string)
    {
        $this->html[] = htmlspecialchars($string);
    }

    /**
     * Adds a table row, eg "<tr><td>abc</td></tr>
     *
     * @param string $row_type
     * @see   $row_type in self::$default_tags
     */
    function add_table_row($row_type = '+-')
    {
        $this->html[] = $this->start_tags['+-']['tr'];

        if ($this->table_cell_type == 'th') {
            // this is the first row, sets the cells to data or headers
            $cell_type = $row_type == '+-' ? 'td' : 'th';
        } else {
            // this is not the first row, cells may only have data
            $cell_type = 'td';
        }

        foreach ($this->table_cells as $index => $cell) {
            $cell_data = implode($this->start_tags['br'], $cell);
            $this->html[] = $this->get_cell_start_tag($cell_type, $index, $cell_data);
            $this->html[] = $cell_data;
            $this->html[] = $this->end_tags['|'][$cell_type];
        }

        $this->html[] = $this->end_tags['+-']['tr'];

        $this->table_cells = [];
        $this->table_cell_type = 'td';
    }

    /**
     * Closes embedded lists, eg "</li></ul></li></ul>"
     *
     * @param string $list_type eg "- ", there must be an entry with the same value in $this->list_types except the last one
     *
     * @see   $list_type in self::$default_tags
     */
    function close_embedded_lists($list_type)
    {
        do {
            $previous_list_type = array_pop($this->list_types);
            $this->html[] = $this->end_tags[$previous_list_type]['li'];
            $this->html[] = $this->end_tags[$previous_list_type]['ul'];
            $last_list_type = end($this->list_types);
        } while ($last_list_type and $last_list_type != $list_type);
    }

    /**
     * Closes the current list or embeded lists, eg "</li></ul></li></ul>"
     *
     * @see $list_type in self::$default_tags
     */
    function close_list()
    {
        while ($list_type = array_pop($this->list_types)) {
            $this->html[] = $this->end_tags[$list_type]['li'];
            $this->html[] = $this->end_tags[$list_type]['ul'];
        }
    }

    /**
     * Closes a table, eg "</table>
     */
    function close_table()
    {
       if ($this->table_cells) {
            // the last table row separator has been omitted, adds the row
            $this->add_table_row();
        }

        $this->html[] = $this->end_tags['+-']['table'];
        $this->table_cell_type = null;
    }

    /**
     * Explodes the text into lines
     *
     * @param  string $text
     * @return array
     */
    function explode_text($text)
    {
        $text = trim($text, ' ');
        $lines = explode("\n", $text);
        $lines = array_map('trim', $lines);

        return $lines;
    }

    /**
     * Returns the cell start tag
     *
     * @param  string $cell_type "th" or "td"
     * @param  int    $index
     * @param  string $cell_data
     * @return string
     */
    function get_cell_start_tag($cell_type, $index, $cell_data)
    {
        if ($cell_type == 'th') {
            $cell_start_tag = $this->start_tags['|']['th'];

        } else {
            if (empty($this->table_cells_alignment[$index])) {
                $alignment = is_numeric($cell_data) ? 'right' : 'inherit';
            } else {
                $alignment = $this->table_cells_alignment[$index];
            }

            $cell_start_tag = sprintf($this->start_tags['|']['td'], $alignment);
        }

        return $cell_start_tag;
    }

    /**
     * Returns the ordered list item including its start number and type
     *
     * The ol tag type is limited to "1", "A", "a".
     * The ol tag start number is limited to 26 for the letter type.
     *
     * @param  array      $lines
     * @param  int        $index
     * @return array|null [$list_type, $ol_start, $ol_type, $list_item]
     *                    eg ["#1", "1", "1", "abc"] or ["#A", "1", "A", "abc"]
     * @see    $list_type in self::$default_tags
     */
    function get_ordered_list_item(array $lines, $index)
    {
        if ($this->table_cell_type or $this->get_underline($lines, $index + 1)) {
            // this is a list inside a table (not processed) or actually a title as it is underlined
            return null;
        }

        $line = $lines[$index];

        if (preg_match('~^#(\d+) +(.*)$~', $line, $match) or preg_match('~^(\d+)\. +(.*)$~', $line, $match)) {
            list(, $ol_start, $list_item) = $match;
            $list_type = '#1';
            $ol_type   = '1';

        } else if (preg_match('~^#([A-Z]+) +(.*)$~', $line, $match) or preg_match('~^([A-Z]+)\. +(.*)$~', $line, $match)) {
            list(, $letter, $list_item) = $match;
            $list_type = '#A';
            $ol_start  = ord($letter) - ord('A') + 1;
            $ol_type   = 'A';

        } else if (preg_match('~^#([a-z]+) +(.*)$~', $line, $match) or preg_match('~^([a-z]+)\. +(.*)$~', $line, $match)) {
            list(, $letter, $list_item) = $match;
            $list_type = '#a';
            $ol_start  = ord($letter) - ord('a') + 1;
            $ol_type   = 'a';

        } else {
            // this is not a list item
            return null;
        }

        $list_type_item = [$list_type, (int) $ol_start, $ol_type, $list_item];

        return $list_type_item;
    }

    /**
     * Determines the cells alignment
     *
     * @param string $row_separator
     * @see   $row_type in self::$default_tags
     */
    function get_table_cells_alignment($row_separator)
    {
        $row_separator = trim($row_separator, '+');
        $pieces = explode('+', $row_separator);

        foreach ($pieces as $piece) {
            if ($piece[0] == '~') {
                $this->table_cells_alignment[] = 'left';

            } else if (substr($piece, -1) == '~') {
                $this->table_cells_alignment[] = 'right';

            } else if (strpos($piece, '~')) {
                $this->table_cells_alignment[] = 'center';

            } else {
                $this->table_cells_alignment[] = null;
            }
        }
    }

    /**
     * Returns the cells of a table row
     *
     * @param  array      $lines
     * @param  int        $index
     * @return array|null eg ["abc", "def"]]
     */
    function get_table_cells(array $lines, $index)
    {
        if (! preg_match('~^\|(.*)\|$~', $lines[$index], $match)) {
            return null;
        }

        $cells = explode('|', $match[1]);
        $cells = array_map('trim', $cells);

        return $cells;
    }

    /**
     * Returns the table row type
     *
     * @param  array  $lines
     * @param  int    $index
     * @return string
     * @see    $row_type in self::$default_tags
     */
    function get_table_row_type(array $lines, $index)
    {
        $row_type = preg_match('/^(\+[=~-])/', $lines[$index], $match) ? $match[1] : null;

        return $row_type;
    }

    /**
     * Returns the title type
     *
     * @param  array  $lines
     * @param  int    $index
     * @return string
     * @see    $underline_type in self::$default_tags
     */
    function get_title_type(array $lines, $index)
    {
        $title_type = $this->get_underline($lines, $index + 1);

        return $title_type;
    }

    /**
     * Returns the underline or title type
     *
     * @param  array  $lines
     * @param  int    $index
     * @return string|null the underline key, eg "=="
     * @see    $underline_type in self::$default_tags
     */
    function get_underline($lines, $index)
    {
        if (! isset($lines[$index])){
            return null;

        }
        $underline_type = preg_match('~^([=+*-])\1~', $lines[$index], $match) ? $match[0] : null;

        return $underline_type;
    }

    /**
     * Return the unordered list item including its type

     * @param  string $line
     * @return array|null [$list_type, $list_item], eg ["- ", "abc"]
     * @see    $list_type in self::$default_tags
     */
    function get_unordered_list_item($line)
    {
        if ($this->table_cell_type or ! preg_match('~^([=*+-] ) *(.*)$~', $line, $match)) {
            // this is a list inside a table (not processed) or not a list item
            return null;
        }

        list(, $list_type, $list_item) = $match;

        return [$list_type, $list_item];
    }

    /**
     * Checks wether the following line is a title skipping blank lines
     *
     * @param  array   $lines
     * @param  int     $index
     * @return boolean
     */
    function is_title_next_line(array $lines, $index)
    {
        // skips blank lines
        do {
            $index++;
        } while (isset($lines[$index]) and $lines[$index] == '');

        $is_title_next = (bool) $this->get_title_type($lines, $index);

        return $is_title_next;
    }

    /**
     * Checks wether a blank line is needed after a line
     *
     * @param array $lines
     * @param int   $index
     */
    function need_blank_line(array $lines, $index)
    {
        $index++;

        $no_need_blank_line = (! isset($lines[$index]) or
            $this->get_ordered_list_item($lines, $index) or
            $this->get_unordered_list_item($lines[$index]) or
            $this->get_table_row_type($lines, $index) or
            $this->get_table_cells($lines, $index));

        return ! $no_need_blank_line;
    }

    /**
     * Opens an item list, eg "<ul><li>abc"
     *
     * @param string $list_type eg "- "
     * @param string $list_item
     * @param string $list_start_tag
     * @see   $list_type in self::$default_tags
     */
    function open_list($list_type, $list_item, $list_start_tag = null)
    {
        if (! $list_start_tag) {
            $list_start_tag = $this->start_tags[$list_type]['ul'];
        }

        $this->html[] = $list_start_tag;
        $this->html[] = $this->start_tags[$list_type]['li'];
        $this->add_string($list_item);

        $this->list_types[] = $list_type;
    }

    /**
     * Opens a table, eg "<table>"
     */
    function open_table()
    {
        $this->html[] = $this->start_tags['+-']['table'];
        $this->table_cell_type = 'th';
        $this->table_cells_alignment = null;
    }

    /**
     * Processes a blank line, eg "br />"
     *
     * @param array  $lines
     * @param string $index
     */
    function process_blank_line(array $lines, $index = null)
    {
        if ($this->table_cell_type) {
            // this is the end of a table, closes the table
            $this->close_table();
            $this->ignore_blank_line = true;
        }

        if ($this->list_types) {
            // this is the end of a list or embedded lists, closes the list(s)
            $this->close_list();
            $this->ignore_blank_line = true;
        }

        if (! $index) {
            // this is (passed) the end of the text
            return;
        }

        if ($this->ignore_blank_line or
            $this->get_underline($lines, $index + 1) or
            $this->is_title_next_line($lines, $index))
        {
            // the previous line is an underline table or list,
            // or the following line is a horizontal line or a title, ignores the blank line

        } else  if (isset($lines[$index])) {
            // this is a line break, adds the line break
            $this->html[] = $this->start_tags['br'];
        }

        $this->ignore_blank_line = false;
    }

    /**
     * Processes a line of text
     *
     * @param array $lines
     * @param int   $index
     */
    function process_line(array $lines, $index)
    {
        $line = $lines[$index];

        if (! $line) {
            $this->process_blank_line($lines, $index);

        } else if ($title_type = $this->get_title_type($lines, $index)) {
            $this->process_title($line, $title_type);

        } else if ($this->get_underline($lines, $index)) {
            $this->process_underline($line);

        } else if ($list_item = $this->get_unordered_list_item($line)) {
            $this->process_unordered_list_item($list_item);
            $this->add_blank_line_in_list_item($lines, $index);

        } else if ($list_item = $this->get_ordered_list_item($lines, $index)) {
            $this->process_ordered_list_item($list_item);
            $this->add_blank_line_in_list_item($lines, $index);

        } else if ($row_type = $this->get_table_row_type($lines, $index)) {
            $this->process_table_row($row_type, $line);

        } else if ($cells = $this->get_table_cells($lines, $index)) {
            $this->process_table_cells($cells);

        } else if ($this->is_title_next_line($lines, $index)) {
            $this->add_string($line);

        } else if (isset($lines[$index+1]) and $this->need_blank_line($lines, $index)) {
            $this->add_line($line);

        } else {
            $this->add_string($line);
        }
    }

    /**
     * Processes an ordered list item
     *
     * @param array  $list_type_item eg ["#1", "1", "1", "abc"]
     */
    function process_ordered_list_item($list_type_item)
    {
        list($list_type, $ol_start, $ol_type, $list_item) = $list_type_item;
        $list_start_tag = sprintf($this->start_tags[$list_type]['ul'], $ol_start, $ol_type);
        $this->process_unordered_list_item([$list_type, $list_item], $list_start_tag);
    }

    /**
     * Processes replacement in the html
     *
     * @param  string $html
     * @return string
     */
    function process_replacements($html)
    {
        foreach ($this->options['replacements'] as $replacement) {
            $html = preg_replace($replacement['pattern'], $replacement['replacement'], $html);
        }

        return $html;
    }

    /**
     * Processes table cells
     *
     * @param array $cells eg ['abc', 'def']
     */
    function process_table_cells(array $cells)
    {
        if (! $this->table_cell_type) {
            // the initial table row separator has been omitted, opens the table
            $this->open_table();
        }

        foreach ($cells as $index => $cell) {
            $this->table_cells[$index][] = htmlspecialchars($cell);
        }

        $this->ignore_blank_line = false;
    }

    /**
     * Processes a table row
     *
     * @param string $row_type
     * @param string $row_separator
     * @see   $row_type in self::$default_tags
     */
    function process_table_row($row_type, $row_separator = null)
    {
        if (! $this->table_cell_type) {
            // this is a new table, opens the table
            $this->open_table();
            $this->get_table_cells_alignment($row_separator);

        } else if ($this->table_cells) {
            // this an existing table, adds the row
            $this->add_table_row($row_type);
        }

        $this->ignore_blank_line = false;
    }

    /**
     * Converts the text into html
     *
     * @param  string $text
     * @return string
     */
    function process_text($text)
    {
        $lines = $this->explode_text($text);

        foreach ($lines as $index => $line) {
            $this->process_line($lines, $index);
        }

        $this->process_blank_line($lines);

        $html = implode("\n", $this->html);
        $html = $this->process_replacements($html);

        return $html;
    }

    /**
     * Processes the title, eg "<h1>abc></h1>
     *
     * @param string $title
     * @param string $title_type
     * @see   $title_type in self::$default_tags
     */
    function process_title($title, $title_type)
    {
        $this->html[] = $this->start_tags[$title_type];
        $this->add_string($title);
        $this->html[] = $this->end_tags[$title_type];

        $this->ignore_blank_line = true;
    }

    /**
     * Processes an underline, eg "----------"
     *
     * @param string $underline
     */
    function process_underline($underline)
    {
        if (! $this->ignore_blank_line) {
            // this is an horizontal line, adds the horizontal line
            $this->html[] = $this->start_tags['hr'];
        }

        $this->ignore_blank_line = true;
    }

    /**
     * Processes a list item
     *
     * @param array  $list_type_item eg ["- ", "abc"]
     * @param string $list_start_tag
     */
    function process_unordered_list_item(array $list_type_item, $list_start_tag = null)
    {
        list($list_type, $list_item) = $list_type_item;
        $current_list_type = end($this->list_types);

        if (! $current_list_type) {
            // this is a new list, opens the list
            $this->open_list($list_type, $list_item, $list_start_tag);

        } else if ($list_type == $current_list_type) {
            // this is an item in the same list, adds the item
            $this->add_list_item($list_type, $list_item);

        } else if (! in_array($list_type, $this->list_types)) {
            // this is an embedded list, opens the list
            $this->open_list($list_type, $list_item, $list_start_tag);

        } else {
            // this is an item from a parent list, closes the embedded list(s), adds the item
            $this->close_embedded_lists($list_type);
            $this->add_list_item($list_type, $list_item);
        }

        $this->ignore_blank_line = false;
    }

    /**
     * Sets a end tag
     *
     * @param  mixed     $tag, eg "<h1>" or ["li" => "<li>", "ul" => "<ul>"]
     * @throws Exception
     * @return mixed     eg "</h1>" or ["li" => "</li>", "ul" => "</ul>"]
     */
    function set_end_tag($tag)
    {
        if (is_array($tag)) {
            $end_tag = array_map([$this, 'set_end_tag'], $tag);

        } else if (preg_match('~<(\w+)~', $tag, $match)) {
            $end_tag = sprintf('</%s>', $match[1]);

        } else {
            throw new Exception("invalid tag: $tag");
        }

        return $end_tag;
    }

    /**
     * Sets the ends tags
     *
     */
    function set_end_tags()
    {
        $this->end_tags = $this->set_end_tag($this->start_tags);
    }

    /**
     * Sets the options, passed options + default options
     *
     * @param array $options
     */
    function set_options(array $options = null)
    {
        if ($options) {
            $this->options = $options + $this->default_options;
        } else {
            $this->options = $this->default_options;
        }
    }

    /**
     * Sets the start tags, passed tags + default tags
     *
     * @param array $tags
     */
    function set_start_tags(array $tags = null)
    {
        if ($tags) {
            $this->start_tags = $tags + $this->default_tags;
        } else {
            $this->start_tags = $this->default_tags;
        }
    }
}
