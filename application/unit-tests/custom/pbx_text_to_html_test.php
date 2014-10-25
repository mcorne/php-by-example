<?php
/**
 * PHP By Example
 *
 * @copyright 2014 Michel Corne <mcorne@yahoo.com>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class pbx_text_to_html_test extends unit_test_core
{
    function _get_start_tags_without_attribute($start_tags = null)
    {
        if (! $start_tags) {
            $pbx_text_to_html = new pbx_text_to_html();
            $start_tags = $pbx_text_to_html->default_tags;
        }

        if (is_array($start_tags)) {
            $start_tags = array_map([$this, __FUNCTION__], $start_tags);

        } else if (preg_match('~^<ol~', $start_tags)) {
            $start_tags = '<ol start="%s" type="%s">';

        } else if (preg_match('~^<(\w+).+?">$~', $start_tags, $match)) {
            $start_tags = '<' . $match[1] . '>';
        }

        return $start_tags;
    }

    function add_blank_line_in_list_item_test()
    {
        $expected_properties = [ ['html', []] ];
        $results['no-line']   = $this->test_method([ ['']       , 0 ], null, $expected_properties);

        /**********/

        $expected_properties = [ ['html', ['<br />']] ];
        $results['other']     = $this->test_method([ ['', 'abc'], 0 ], null, $expected_properties);

        return $results;
    }

    function add_line_test()
    {
        $expected_properties = [ ['html', ['abc', '<br />']] ];
        $results['line']     = $this->test_method(['abc'], null, $expected_properties);

        return $results;
    }

    function add_list_item_test()
    {
        $expected_properties = [ ['html', ['</li>', '<li>', 'abc']] ];
        $results['item']     = $this->test_method(['- ', 'abc'], null, $expected_properties);

        return $results;
    }

    function add_string_test()
    {
        $expected_properties = [ ['html', ['abc']] ];
        $results['string']   = $this->test_method(['abc'], null, $expected_properties);

        return $results;
    }

    function add_table_row_test()
    {
        $expected_properties = [
            ['html'           , ['<tr>', '</tr>']],
            ['table_cell_type', 'td'],
            ['table_cells'    , []],
        ];
        $results['no-cell'] = $this->test_method(['+-'], null, $expected_properties);

        /**********/

        $expected_properties = [
            ['html'           , ['<tr>', '<th>', 'abc', '</th>', '</tr>']],
            ['table_cell_type', 'td'],
            ['table_cells'    , []],
         ];
        $properties = [
            ['start_tags'     , $this->start_tags_without_attribute],
            ['table_cell_type', 'th'],
            ['table_cells'    , [ ['abc'] ]],
        ];
        $results['one-th-cell'] = $this->test_method(['+='], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'           , ['<tr>', '<td>', 'abc', '</td>', '</tr>']],
            ['table_cell_type', 'td'],
            ['table_cells'    , []],
         ];
        $properties = [
            ['start_tags'     , $this->start_tags_without_attribute],
            ['table_cell_type', 'th'],
            ['table_cells'    , [ ['abc'] ]],
        ];
        $results['one-td-cell'] = $this->test_method(['+-'], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'           , ['<tr>', '<td>', 'abc', '</td>', '<td>', 'def', '</td>', '</tr>']],
            ['table_cell_type', 'td'],
            ['table_cells'    , []],
         ];
        $properties = [
            ['start_tags'     , $this->start_tags_without_attribute],
            ['table_cell_type', 'td'],
            ['table_cells'    , [ ['abc'], ['def'] ]],
        ];
        $results['two-td-cells'] = $this->test_method(['+-'], null, $expected_properties, $properties);

        return $results;
    }

    function close_embedded_lists_test()
    {
        $expected_properties = [
            ['html'      , ['</li>', '</ul>']],
            ['list_types', ['- ']],
        ];
        $properties = [
            ['list_types' , ['- ', '+ ']],
        ];
        $results['two-lists'] = $this->test_method(['- '], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'      , ['</li>', '</ul>', '</li>', '</ul>']],
            ['list_types', ['- ']],
        ];
        $properties = [
            ['list_types' , ['- ', '+ ', '* ']],
        ];
        $results['three-lists'] = $this->test_method(['- '], null, $expected_properties, $properties);

        return $results;
    }

    function close_list_test()
    {
        $expected_properties = [
            ['html'      , []],
            ['list_types', []],
        ];
        $results['no-list'] = $this->test_method([], null, $expected_properties);

        /**********/

        $expected_properties = [
            ['html'      , ['</li>', '</ul>']],
            ['list_types', []],
        ];
        $properties = [
            ['list_types' , ['- ']],
        ];
        $results['one-list'] = $this->test_method([], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'      , ['</li>', '</ul>', '</li>', '</ul>']],
            ['list_types', []],
        ];
        $properties = [
            ['list_types' , ['- ', '* ']],
        ];
        $results['two-lists'] = $this->test_method([], null, $expected_properties, $properties);

        return $results;
    }

    function close_table_test()
    {
        $expected_properties = [
            ['html'           , ['</table>']],
            ['table_cell_type', null],
        ];
        $results['no-cell'] = $this->test_method([], null, $expected_properties);

        /**********/

        $expected_properties = [
            ['html'           , ['<tr>', '<td>', 'abc', '</td>', '<td>', 'def', '</td>', '</tr>', '</table>']],
            ['table_cell_type', null],
        ];
        $properties = [
            ['start_tags'     , $this->start_tags_without_attribute],
            ['table_cell_type', 'td'],
            ['table_cells'    , [ ['abc'], ['def'] ]],
        ];
        $results['cells'] = $this->test_method([], null, $expected_properties, $properties);

        return $results;
    }

    function explode_text_test()
    {
        $results['text'] = $this->test_method(["  \n abc  \n  def  \n  \n ghi  \n  "], ['', 'abc', 'def', '', 'ghi', '']);

        return $results;
    }


    function get_cell_start_tag_test()
    {
        $start_tags = ['|' => ['td' => '<td style="text_align: %s">'], 'br' => '<br />'];

        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['th']     = $this->test_method(['th', 0, 'abc'], '<th>', null, $properties);

        /**********/

        $properties = [
            ['start_tags', $start_tags],
        ];
        $results['string'] = $this->test_method(['td', 0, 'abc'], '<td style="text_align: inherit">', null, $properties);

        /**********/

        $properties = [
            ['start_tags', $start_tags],
        ];
        $results['number'] = $this->test_method(['td', 0, '123'], '<td style="text_align: right">', null, $properties);

        /**********/

        $properties = [
            ['start_tags'           , $start_tags],
            ['table_cells_alignment', ['left']],
        ];
        $results['left']   = $this->test_method(['td', 0, '123'], '<td style="text_align: left">', null, $properties);

        /**********/

        $properties = [
            ['start_tags'           , $start_tags],
            ['table_cells_alignment', ['right']],
        ];
        $results['right']  = $this->test_method(['td', 0, 'abc'], '<td style="text_align: right">', null, $properties);

        /**********/

        $properties = [
            ['start_tags'           , $start_tags],
            ['table_cells_alignment', ['center']],
        ];
        $results['cnter']  = $this->test_method(['td', 0, 'abc'], '<td style="text_align: center">', null, $properties);

        return $results;
    }

    function get_ordered_list_item_test()
    {
        $results['dash-number']          = $this->test_method([ ['#1 abc'] , 0 ], ['#1', 1 , '1', 'abc']);
        $results['number']               = $this->test_method([ ['1. abc'] , 0 ], ['#1', 1 , '1', 'abc']);
        $results['dash_number-start']    = $this->test_method([ ['#10 abc'], 0 ], ['#1', 10, '1', 'abc']);
        $results['number-start']         = $this->test_method([ ['10. abc'], 0 ], ['#1', 10, '1', 'abc']);

        $results['dash-lowercase']       = $this->test_method([ ['#a abc'], 0 ] , ['#a', 1 , 'a', 'abc']);
        $results['lowercase']            = $this->test_method([ ['a. abc'], 0 ] , ['#a', 1 , 'a', 'abc']);
        $results['dash-lowercase-start'] = $this->test_method([ ['#j abc'], 0 ] , ['#1', 10, 'a', 'abc']);
        $results['lowercase-start']      = $this->test_method([ ['j. abc'], 0 ] , ['#1', 10, 'a', 'abc']);

        $results['dash-lowercase']       = $this->test_method([ ['#A abc'], 0 ] , ['#A', 1 , 'A', 'abc']);
        $results['lowercase']            = $this->test_method([ ['A. abc'], 0 ] , ['#A', 1 , 'A', 'abc']);
        $results['dash-lowercase-start'] = $this->test_method([ ['#J abc'], 0 ] , ['#A', 10, 'A', 'abc']);
        $results['lowercase-start']      = $this->test_method([ ['J. abc'], 0 ] , ['#A', 10, 'A', 'abc']);

        $results['equal']  = $this->test_method([ ['=========='], 0 ], null);
        $results['minus']  = $this->test_method([ ['----------'], 0 ], null);
        $results['plus']   = $this->test_method([ ['++++++++++'], 0 ], null);
        $results['star']   = $this->test_method([ ['**********'], 0 ], null);
        $results['string'] = $this->test_method([ ['abc']       , 0 ], null);

        $results['table']  = $this->test_method([ ['1. abc']           , 0 ], null, null, [ ['table_cell_type' , 'td'] ]);
        $results['title']  = $this->test_method([ ['1. abc', '======'] , 0 ], null);

        return $results;
    }

    function get_table_cells_alignment_test()
    {
        $expected_properties = [
            ['table_cells_alignment', ['left', 'center', 'right', null]],
        ];
        $results['alignments'] = $this->test_method(['+~--+-~-+--~+---+'], null, $expected_properties);

        return $results;
    }

    function get_table_cells_test()
    {
        $results['cells']   = $this->test_method([ ['|abc|def|'], 0], ['abc', 'def']);
        $results['no-cell'] = $this->test_method([ ['|abc']     , 0], null);

        return $results;
    }

    function get_table_row_type_test()
    {
        $results['data']      = $this->test_method([ ['+---+---+'], 0], '+-');
        $results['header']    = $this->test_method([ ['+===+===+'], 0], '+=');
        $results['other']     = $this->test_method([ ['abc']      , 0], null);

        return $results;
    }

    function get_title_type_test()
    {
        $results['title']    = $this->test_method([ ['abc', '==='], 0 ], '==');
        $results['no-title'] = $this->test_method([ ['abc', 'xyz'], 0 ], null);
        $results['eot']      = $this->test_method([ ['abc']       , 0 ], null);

        return $results;
    }

    function get_underline_test()
    {
        $results['equal']       = $this->test_method([ ['=========='], 0], '==');
        $results['minus']       = $this->test_method([ ['----------'], 0], '--');
        $results['plus']        = $this->test_method([ ['++++++++++'], 0], '++');
        $results['star']        = $this->test_method([ ['**********'], 0], '**');

        $results['list-minus']  = $this->test_method([ ['- abc'] , 0], null);
        $results['list-plus']   = $this->test_method([ ['+ abc'] , 0], null);
        $results['list-star']   = $this->test_method([ ['* abc'] , 0], null);
        $results['list-dash']   = $this->test_method([ ['#1 abc'], 0], null);
        $results['list-number'] = $this->test_method([ ['1. abc'], 0], null);

        $results['string']      = $this->test_method([ ['abc']   , 0], null);
        $results['blank']       = $this->test_method([ ['']      , 0], null);

        return $results;
    }

    function get_unordered_list_item_test()
    {
        $results['equal-list']  = $this->test_method(['= abc'], ['= ', 'abc']);
        $results['minus-list']  = $this->test_method(['- abc'], ['- ', 'abc']);
        $results['plus-list']   = $this->test_method(['+ abc'], ['+ ', 'abc']);
        $results['star-list']   = $this->test_method(['* abc'], ['* ', 'abc']);

        $results['dash-list']   = $this->test_method(['#1 abc'], null);
        $results['number-list'] = $this->test_method(['1. abc'], null);

        $results['equal']  = $this->test_method(['=========='], null);
        $results['minus']  = $this->test_method(['----------'], null);
        $results['plus']   = $this->test_method(['++++++++++'], null);
        $results['star']   = $this->test_method(['**********'], null);
        $results['string'] = $this->test_method(['abc']       , null);

        $results['table']  = $this->test_method(['- abc']     , null, null, [ ['table_cell_type' , 'td'] ]);

        return $results;
    }

    function is_title_next_line_test()
    {
        $results['next']        = $this->test_method([ ['abc', 'def', '---']            , 0 ], true);
        $results['skip-blanks'] = $this->test_method([ ['abc', '', '', '', 'def', '---'], 0 ], true);
        $results['no-title']    = $this->test_method([ ['abc', 'def', 'ghi']            , 0 ], false);

        return $results;
    }

    function need_blank_line_test()
    {
        $results['no-line']   = $this->test_method([ ['']             , 0 ], false);
        $results['ordered']   = $this->test_method([ ['', '#1 abc']   , 0 ], false);
        $results['unordered'] = $this->test_method([ ['', '= abc']    , 0 ], false);
        $results['row']       = $this->test_method([ ['', '+---+---+'], 0 ], false);
        $results['cells']     = $this->test_method([ ['', '|abc|def|'], 0 ], false);
        $results['other']     = $this->test_method([ ['', 'abc']      , 0 ], true);

        return $results;
    }

    function open_list_test()
    {
        $expected_properties = [
            ['html'      , ['<ul>', '<li>', 'abc']],
            ['list_types', ['- ']],
        ];
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['list'] = $this->test_method(['- ', 'abc'], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'      , ['<ul>', '<li>', 'def']],
            ['list_types', ['* ', '+ ']],
        ];
        $properties = [
            ['list_types', ['* ']],
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['embedded'] = $this->test_method(['+ ', 'def'], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'      , ['<myul>', '<li>', 'abc']],
            ['list_types', ['- ']],
        ];
        $results['custom'] = $this->test_method(['- ', 'abc', '<myul>'], null, $expected_properties);

        return $results;
    }

    function open_table_test()
    {
        $expected_properties = [
            ['html'           , ['<table>']],
            ['table_cell_type', 'th'],
        ];
        $properties = [
            ['start_tags'     , $this->start_tags_without_attribute],
        ];
        $results['table'] = $this->test_method([], null, $expected_properties, $properties);

        return $results;
    }

    function process_blank_line_test()
    {
        $expected_properties = [
            ['html'           , ['</table>']],
            ['table_cell_type', null],
        ];
        $properties = [
            ['table_cell_type', ['td']],
        ];
        $results['close-table'] = $this->test_method([ [] ], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'           , ['</table>']],
            ['table_cell_type', null],
        ];
        $properties = [
            ['table_cell_type', ['td']],
        ];
        $results['close-list'] = $this->test_method([ [] ], null, $expected_properties, $properties);

        /**********/

        $results['eot']         = $this->test_method([ [] ]                   , null, [ ['html', []] ]);
        $results['before-hr']   = $this->test_method([ ['', '----------'], 0 ], null, [ ['html', []] ]);
        $results['after-hr']    = $this->test_method([ ['----------', ''], 1 ], null, [ ['html', []] ], [ ['ignore_blank_line', true] ]);
        $results['line-break']  = $this->test_method([ ['abc', '']       , 1 ], null, [ ['html', ['<br />']] ]);

        return $results;
    }

    function process_line_test()
    {
        $expected_properties = [
            ['html'           , ['</table>']],
            ['table_cell_type', null],
        ];
        $properties = [
            ['table_cell_type', ['td']],
        ];
        $results['blank'] = $this->test_method([ [''], 0 ], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'             , ['<h1>', 'abc', '</h1>']],
            ['ignore_blank_line', true],
        ];
        $properties = [
            ['start_tags'       , $this->start_tags_without_attribute],
        ];
        $results['title'] = $this->test_method([ ['abc', '==='], 0 ], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html', ['<hr />']],
        ];
        $results['underline'] = $this->test_method([ ['----------'], 0 ], null, $expected_properties);

        /**********/

        $expected_properties = [
            ['html'      , ['<ul>', '<li>', 'abc']],
            ['list_types', ['- ']],
        ];
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['undordered'] = $this->test_method([ ['- abc'] , 0], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'      , ['<ol start="1" type="1">', '<li>', 'abc']],
            ['list_types', ['#1']],
        ];
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['ordered'] = $this->test_method([ ['1. abc'], 0 ], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'           , ['<table>']],
            ['table_cell_type', 'th'],
        ];
        $properties = [
            ['start_tags'     , $this->start_tags_without_attribute],
        ];
        $results['row'] = $this->test_method([ ['+--+--+'], 0], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['table_cells', [ ['abc'], ['def'] ]],
        ];
        $results['cells'] = $this->test_method([ ['| abc | def |'], 0 ], null, $expected_properties);

        /**********/

        $expected_properties = [
            ['html', ['abc', '<br />']],
        ];
        $results['line'] = $this->test_method([ ['abc', 'def'], 0 ], null, $expected_properties);

        /**********/

        $expected_properties = [
            ['html', ['abc']],
        ];
        $results['string'] = $this->test_method([ ['abc'], 0 ], null, $expected_properties);

        return $results;
    }

    function process_ordered_list_item_test()
    {
        $expected_properties = [
            ['html'      , ['<ol start="1" type="1">', '<li>', 'abc']],
            ['list_types', ['#1']],
        ];
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['number'] = $this->test_method([ ['#1', 1 , '1', 'abc'] ], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'      , ['<ol start="10" type="a">', '<li>', 'abc']],
            ['list_types', ['#a']],
        ];
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['letter'] = $this->test_method([ ['#a', 10 , 'a', 'abc'] ], null, $expected_properties, $properties);

        return $results;
    }

    function process_replacements_test()
    {
        $results['mail'] = $this->test_method(['abc@mail.com'], '<a href="mailto:abc@mail.com">abc@mail.com</a>');
        $results['http'] = $this->test_method(['http://abc.com'], '<a href="http://abc.com">abc.com</a>');

        return $results;
    }

    function process_table_cells_test()
    {
        $expected_properties = [
            ['table_cells', []],
        ];
        $results['no-cell'] = $this->test_method([ [] ], null, $expected_properties);

        /**********/

        $expected_properties = [
            ['table_cells', [ ['abc'], ['def'] ]],
        ];
        $results['no-row'] = $this->test_method([ ['abc', 'def'] ], null, $expected_properties);

        /**********/

        $expected_properties = [
            ['table_cells', [ ['abc', ''], ['def', 'uvw'], ['' ,'xyz'] ]],
        ];
        $properties = [
            ['table_cells', [ ['abc'], ['def'], [''] ]],
        ];
        $results['add'] = $this->test_method([ ['', 'uvw', 'xyz'] ], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'           , ['<table>']],
            ['table_cell_type', 'th'],
            ['table_cells'    , []],
        ];
        $properties = [
            ['start_tags'     , $this->start_tags_without_attribute],
        ];
        $results['open'] = $this->test_method([ [] ], null, $expected_properties, $properties);

        return $results;
    }

    function process_table_row_test()
    {
        $expected_properties = [
            ['html'                 , ['<table>']],
            ['table_cell_type'      , 'th'],
            ['table_cells_alignment', ['left']],
        ];
        $properties = [
            ['start_tags'           , $this->start_tags_without_attribute],
        ];
        $results['open'] = $this->test_method(['+-', '+~--+'], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'           , ['<tr>', '<th>', 'abc', '</th>', '</tr>']],
            ['table_cell_type', 'td'],
            ['table_cells'    , []],
         ];
        $properties = [
            ['start_tags'     , $this->start_tags_without_attribute],
            ['table_cell_type', 'th'],
            ['table_cells'    , [ ['abc'] ]],
        ];
        $results['add'] = $this->test_method(['+='], null, $expected_properties, $properties);

        return $results;
    }

    function process_text_test()
    {
        $text = $this->trim('
                aaaaa
                bbbbb
                ');
        $expected = $this->trim('
                aaaaa
                <br />
                bbbbb
                <br />
                <br />');
        $results['strings'] = $this->test_method([$text], $expected);

        /**********/

        $text = $this->trim('
                aaaaa
                =====

                bbbbb
                ccccc

                ddddd
                -----

                eeeee
                fffff');
        $expected = $this->trim('
                <h1>
                aaaaa
                </h1>
                bbbbb
                <br />
                ccccc
                <h2>
                ddddd
                </h2>
                eeeee
                <br />
                fffff');
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['titles'] = $this->test_method([$text], $expected, null, $properties);

        /**********/

        $text = $this->trim('
                uvw:
                - abc
                - def
                  ghi');
        $expected = $this->trim('
                uvw:
                <ul>
                 <li>
                   abc
                 </li>
                  <li>
                    def
                    <br />
                    ghi
                  </li>
                </ul>');
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['unordered'] = $this->test_method([$text], $expected, null, $properties);

        /**********/

        $text = $this->trim('
                1. abc
                2. def');
        $expected = $this->trim('
                <ol start="1" type="1">
                  <li>
                    abc
                  </li>
                  <li>
                    def
                  </li>
                </ol>');
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['ordered'] = $this->test_method([$text], $expected, null, $properties);

        /**********/

        $text = $this->trim('
                - abc
                - def
                * uvw
                * xyz
                - ghi');
        $expected = $this->trim('
                <ul>
                  <li>
                    abc
                  </li>
                  <li>
                    def
                    <ul>
                      <li>
                        uvw
                      </li>
                      <li>
                        xyz
                      </li>
                    </ul>
                  </li>
                  <li>
                    ghi
                  </li>
                </ul>');
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['embedded'] = $this->test_method([$text], $expected, null, $properties);

        /**********/

        $text = $this->trim('
                +-----+-----+-----+
                | aaa | bbb |     |
                +=====+=====+=====+
                | ddd | eee |     |
                | DDD |     | FFF |
                +-----+-----+-----+');
        $expected = $this->trim('
                <table>
                  <tr>
                    <th>
                      aaa
                    </th>
                    <th>
                      bbb
                    </th>
                    <th>

                    </th>
                  </tr>
                  <tr>
                    <td>
                      ddd<br />DDD
                    </td>
                    <td>
                      eee<br />
                    </td>
                    <td>
                      <br />FFF
                    </td>
                  </tr>
                </table>');
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['cells'] = $this->test_method([$text], $expected, null, $properties);

        /**********/

        $text = $this->trim('
                +-----+-----+-----+
                | 123 | - aaa     |
                |     | - bbb     |
                +-----+-----+-----+');
        $expected = $this->trim('
                <table>
                  <tr>
                    <td>
                      123<br />
                    </td>
                    <td>
                      - aaa<br />- bbb
                    </td>
                  </tr>
                </table>');
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['table-list'] = $this->test_method([$text], $expected, null, $properties);

        /**********/

        $results['replacement'] = $this->test_method(['abc@mail.com'], '<a href="mailto:abc@mail.com">abc@mail.com</a>');

        return $results;
    }

    function process_title_test()
    {
        $expected_properties = [
            ['html'             , ['<h1>', 'abc', '</h1>']],
            ['ignore_blank_line', true],
        ];
        $properties = [
            ['start_tags'       , $this->start_tags_without_attribute],
        ];
        $results['title'] = $this->test_method(['abc', '=='], null, $expected_properties, $properties);

        return $results;
    }

    function process_underline_test()
    {
        $expected_properties = [
            ['html'    , []],
            ['ignore_blank_line', true],
        ];
        $properties = [
            ['ignore_blank_line', true],
        ];
        $results['title'] = $this->test_method(['----------'], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html', ['<hr />']],
        ];
        $results['hr-line'] = $this->test_method(['----------'], null, $expected_properties);

        return $results;
    }

    function process_unordered_list_item_test()
    {
        $expected_properties = [
            ['html'      , ['<ul>', '<li>', 'abc']],
            ['list_types', ['- ']],
        ];
        $properties = [
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['open'] = $this->test_method([ ['- ', 'abc'] ], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'      , ['<myul>', '<li>', 'abc']],
            ['list_types', ['- ']],
        ];
        $results['custom'] = $this->test_method([ ['- ', 'abc'], '<myul>' ], null, $expected_properties);

        /**********/

        $expected_properties = [
            ['html'      , ['</li>', '<li>', 'abc']],
            ['list_types', ['- ']],
        ];
        $properties = [
            ['list_types', ['- ']],
        ];
        $results['add'] = $this->test_method([ ['- ', 'abc'] ], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'      , ['<ul>', '<li>', 'abc']],
            ['list_types', ['+ ', '- ']],
        ];
        $properties = [
            ['list_types', ['+ ']],
            ['start_tags', $this->start_tags_without_attribute],
        ];
        $results['embedded'] = $this->test_method([ ['- ', 'abc'] ], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['html'      , ['</li>', '</ul>', '</li>', '<li>', 'abc']],
            ['list_types', ['- ']],
        ];
        $properties = [
            ['list_types', ['- ', '+ ']],
        ];
        $results['parent'] = $this->test_method([ ['- ', 'abc'] ], null, $expected_properties, $properties);

        return $results;
    }

    function set_end_tag_test()
    {
        $results['tag'] = $this->test_method(['<h1>'], '</h1>');
        $results['tag'] = $this->test_method([ ['li' => '<li>', 'ul' => '<ul>'] ], ['li' => '</li>', 'ul' => '</ul>']);

        return $results;
    }

    function set_end_tags_test()
    {
        $expected_properties = [
            ['end_tags'  , ['==' => '</myh1>', '--' => '</h2>']],
        ];
        $properties = [
            ['start_tags', ['==' => '<myh1>', '--' => '<h2>']],
        ];
        $results['tags'] = $this->test_method([], null, $expected_properties, $properties);

        return $results;
    }

    function set_options_test()
    {
        $expected_properties = [
            ['options'        , ['abc' => '123'  , 'def' => '456']],
        ];
        $properties = [
            ['default_options', ['abc' => '123'  , 'def' => '456']],
        ];
        $results['no-options'] = $this->test_method([], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['options'        , ['abc' => '789'  , 'def' => '456']],
        ];
        $properties = [
            ['default_options', ['abc' => '123'  , 'def' => '456']],
        ];
        $results['options'] = $this->test_method([ ['abc' => '789'] ], null, $expected_properties, $properties);

        return $results;
    }

    function set_start_tags_test()
    {
        $expected_properties = [
            ['default_tags', ['==' => '<h1>'  , '--' => '<h2>']],
        ];
        $properties = [
            ['default_tags', ['==' => '<h1>'  , '--' => '<h2>']],
        ];
        $results['no-tags'] = $this->test_method([], null, $expected_properties, $properties);

        /**********/

        $expected_properties = [
            ['start_tags'  , ['==' => '<myh1>', '--' => '<h2>']],
        ];
        $properties = [
            ['default_tags', ['==' => '<h1>'  , '--' => '<h2>']],
        ];
        $results['tags'] = $this->test_method([ ['==' => '<myh1>'] ], null, $expected_properties, $properties);

        return $results;
    }

    function trim($string)
    {
        $string = ltrim($string);
        $trimmed = preg_replace('~^ +~m', '', $string);

        return $trimmed;
    }
}
