<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

class pdo__setattribute extends function_core
{
    public $constant_prefix = [
        'attribute' => 'PDO::ATTR',
        'value'     => 'PDO::',
    ];

    public $examples = [
        ['PDO::ATTR_CASE', 'PDO::CASE_LOWER'],
        ['PDO::ATTR_CASE', 'PDO::ATTR_CURSOR'],
    ];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:", null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        inject_function_call

        // shows the attribute
        if ($bool) {
            $mixed = $pdo->getAttribute($attribute);
        }
    ';

    public $synopsis = 'public bool PDO::setAttribute ( int $attribute , mixed $value )';

    function post_exec_function()
    {
        if ($this->result['bool']) {
            $attribute = $this->_filter->filter_arg_value('attribute');
            $this->result['mixed'] = $this->object->getAttribute($attribute);
        }
    }

    function pre_exec_function()
    {
        $this->object = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}
