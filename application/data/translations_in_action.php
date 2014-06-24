<?php
/**
 * PHP By Example
 *
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2014 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/*
 * urls to show translated messages in action
 * sets the url parameters passed to output::display_url() in translation_form.phtml
 */

define('USE_INFINITIVE', 'Use the infinitive (prefered way) or the <a class="gray" href="http://en.wikipedia.org/wiki/T%E2%80%93V_distinction">formal way</a>, if applicable in your language.');
define('USE_TV_DISTINCTION', 'Use the <a class="gray" href="http://en.wikipedia.org/wiki/T%E2%80%93V_distinction">formal way</a>, if applicable in your language.');

return [

1000 => "Top bar",
1001 => ['function', null, '?search_method=input&no_auto_highlight=1' , 'translation_note' => USE_INFINITIVE],
1003 => ['function', null, '?search_method=select&no_auto_highlight=1', 'translation_note' => USE_INFINITIVE],
1005 => ['function', null, '?search_method=input' , 'translation_note' => USE_INFINITIVE],
1006 => ['function', null, '?search_method=select', 'translation_note' => USE_INFINITIVE],

1100 => "Home page",
1101 => 'home',
1102 => ['home', 'translation_note' => USE_TV_DISTINCTION],
1103 => ['home', 'translation_note' => USE_TV_DISTINCTION],
1104 => ['home', 'translation_note' => USE_TV_DISTINCTION],
1105 => 'home',
1106 => ['home', 'translation_note' => USE_TV_DISTINCTION],
1107 => 'home',
1109 => 'home',

1200 => "Bottom bar",
1202 => 'home',
1204 => ['function', 'abs'],
1205 => 'misc',

1300 => "PHP manual location",
1304 => ['function', 'abs', '?php_manual_location=local_copy&no_auto_highlight=1'],
1306 => ['function', 'abs', '?php_manual_location=none&no_auto_highlight=1', 'translation_note' => USE_INFINITIVE],
1307 => ['function', 'abs', '?php_manual_location=php.net&no_auto_highlight=1'],

1400 => "Function page",
1401 => ['function', 'abs', '?no_auto_highlight=1', 'translation_note' => USE_INFINITIVE],
1402 => ['function', 'abs'],
1403 => ['function', 'abs'],
1404 => ['function', 'abs', 'translation_note' => USE_INFINITIVE],

1500 => "Function input",
1501 => ['function', 'preg_match_all', 'translation_note' => 'Click on the blue question mark in the separate tab.'],

1600 => "Search function page",
1601 => ['function', 'xyz'],
1602 => ['function', 'xyz'],

1700 => "Error types",
1701 => ['function', 'abs', '?example=3'],
1702 => null, // cannot show example of "PHP error",
1703 => ['function', 'iconv', '?example=3'],
1704 => ['function', 'file_get_contents', '?example=5'],
1705 => ['function', 'abs', '?example=4'],
1706 => ['function', 'file_get_contents', '?example=6'],
1707 => ['function', 'array_filter', '?example=6'],

1800 => "Parser errors",
1801 => ['function', 'abs', '?example=5'],
1802 => ['function', 'abs', '?example=7'],
1803 => ['function', 'abs', '?example=8'],
1804 => ['function', 'abs', '?example=4'],
1805 => ['function', 'abs', '?example=6'],
1806 => ['function', 'abs', '?example=9'],

1900 => "Argument filter errors",
1901 => ['function', 'file_get_contents', '?example=9'],
1902 => ['function', 'file_get_contents', '?example=10'],
1903 => ['function', 'array_filter', '?example=7'],
1904 => ['function', 'array_filter', '?example=6'],
1905 => ['function', 'file_get_contents', '?example=8'],
1906 => ['function', 'current', '?example=9'],
1907 => ['function', 'print_r', '?example=3'],

2000 => "Function errors",
2001 => ['function', 'sort', '?example=3'],
2002 => ['function', 'DateTime::add', '?example=5'],
2003 => ['function', 'abs', '?example=3'],
2004 => ['function', 'DateTime::add', '?example=5'],
2005 => ['function', 'file_get_contents', '?example=6'],
2006 => ['function', 'file_get_contents', '?example=7'],

2100 => "Parameter errors",
2101 => ['function', 'abs', '?example=10'],

2200 => "Help page",
2201 => ["help", 'translation_note' => USE_TV_DISTINCTION],
2202 => ["help", 'translation_note' => USE_TV_DISTINCTION],
2203 => ["help", 'translation_note' => USE_TV_DISTINCTION],
2204 => ["help", 'translation_note' => USE_INFINITIVE],
2206 => ["help", 'translation_note' => USE_TV_DISTINCTION],
2207 => ["help", 'translation_note' => USE_INFINITIVE],
2208 => ["help", 'translation_note' => USE_TV_DISTINCTION],
2209 => ["help", 'translation_note' => USE_TV_DISTINCTION],
2210 => ["help", 'translation_note' => USE_INFINITIVE],

2300 => "Misc page",
2301 => "about",
2302 => "about",
2303 => "about",
2305 => "about",

2400 => "Other items",
2401 => ['test', 'abs'],

2500 => "Unavailable PHP manual notice",
2501 => ['function', 'abs'],
2502 => ['function', 'abs'],

];
