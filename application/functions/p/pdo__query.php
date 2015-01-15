<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

class pdo__query extends function_core
{
    public $constant_prefix = [
        'fetch_style' => 'PDO::FETCH',
        'mode'        => 'PDO::FETCH',
    ];

    public $examples = [
        [
            'exec_statement' =>
"CREATE TABLE fruit
    (name, color, calories);

INSERT INTO fruit VALUES
    ('apple', 'red', 150),
    ('banana', 'yellow', 250),
    ('kiwi', 'brown', 75),
    ('lemon', 'yellow', 25),
    ('orange', 'orange', 300),
    ('pear', 'green', 150),
    ('watermelon', 'pink', 90)",
"SELECT name, color, calories
FROM fruit
ORDER BY name",
            'fetch_style' => 'PDO::FETCH_ASSOC',
        ],

        [
            'exec_statement' =>
"CREATE TABLE fruit
    (name, color, calories);

INSERT INTO fruit VALUES
    ('apple', 'red', 150),
    ('banana', 'yellow', 250),
    ('kiwi', 'brown', 75),
    ('lemon', 'yellow', 25),
    ('orange', 'orange', 300),
    ('pear', 'green', 150),
    ('watermelon', 'pink', 90)",
"SELECT calories
FROM fruit
ORDER BY calories",
            'PDO::FETCH_COLUMN',
            0,
        ],

        [
            'exec_statement' =>
"CREATE TABLE fruit
    (name, color, calories);

INSERT INTO fruit VALUES
    ('apple', 'red', 150),
    ('banana', 'yellow', 250),
    ('kiwi', 'brown', 75),
    ('lemon', 'yellow', 25),
    ('orange', 'orange', 300),
    ('pear', 'green', 150),
    ('watermelon', 'pink', 90)",
"SELECT name, color, calories
FROM fruit
ORDER BY name DESC",
            'PDO::FETCH_CLASS',
            'StdClass',
        ],

        [
            'exec_statement' =>
"CREATE TABLE fruit
    (name, color, calories);

INSERT INTO fruit VALUES
    ('apple', 'red', 150),
    ('banana', 'yellow', 250),
    ('kiwi', 'brown', 75),
    ('lemon', 'yellow', 25),
    ('orange', 'orange', 300),
    ('pear', 'green', 150),
    ('watermelon', 'pink', 90)",
"SELECT name, color, calories
FROM fruit
ORDER BY name DESC",
            'PDO::FETCH_INTO',
            '_NO_QUOTE_new StdClass()',
        ],
    ];

    public $input_args = ['exec_statement'];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:", null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $int = $pdo->exec(
            $exec_statement  // string $exec_statement
        );

        inject_function_call

        // shows the query result
        $rows = $PDOStatement->fetchAll(
            $fetch_style  // int $fetch_style
        );
    ';

    public $synopsis       = 'public PDOStatement PDO::query ( string $statement, int $mode = null , int $colno = null )';
    public $synopsis_fixed = 'public PDOStatement PDO::query ( string $statement, int $mode = null , mixed $mixed = null )';

    function post_exec_function()
    {
        if ($statement = $this->result['PDOStatement']) {
            $this->result['PDOStatement'] = get_class($statement);
            $fetch_style = $this->_filter->filter_arg_value('fetch_style');
            $this->result['rows'] = $statement->fetchAll($fetch_style);
        }
    }

    function pre_exec_function()
    {
        $this->object = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $statement = $this->_filter->filter_arg_value('exec_statement');
        $this->result['int'] = $this->object->exec($statement);
    }
}
