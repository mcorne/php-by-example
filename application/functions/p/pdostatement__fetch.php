<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/p/pdo__prepare.php';
require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class pdostatement__fetch extends function_core
{
    public $constant_prefix = [
        'cursor_orientation' => 'PDO::FETCH_ORI',
        'fetch_style'        => 'PDO::FETCH',
    ];

    public $examples = [
        [
            'exec_statement' =>
"CREATE TABLE fruit
    (name, colour, calories INT);

INSERT INTO fruit VALUES
    ('apple', 'red', 150),
    ('banana', 'yellow', 250),
    ('kiwi', 'brown', 75),
    ('lemon', 'yellow', 25),
    ('orange', 'orange', 300),
    ('pear', 'green', 150),
    ('watermelon', 'pink', 90)",
            'statement' =>
"SELECT name, colour, calories FROM fruit",
            'PDO::FETCH_ASSOC',
        ],

        [
            'exec_statement' =>
"CREATE TABLE fruit
    (name, colour, calories INT);

INSERT INTO fruit VALUES
    ('apple', 'red', 150),
    ('banana', 'yellow', 250),
    ('kiwi', 'brown', 75),
    ('lemon', 'yellow', 25),
    ('orange', 'orange', 300),
    ('pear', 'green', 150),
    ('watermelon', 'pink', 90)",
            'statement' =>
"SELECT name, colour, calories FROM fruit",
            'PDO::FETCH_BOTH',
        ],

        [
            'exec_statement' =>
"CREATE TABLE fruit
    (name, colour, calories INT);

INSERT INTO fruit VALUES
    ('apple', 'red', 150),
    ('banana', 'yellow', 250),
    ('kiwi', 'brown', 75),
    ('lemon', 'yellow', 25),
    ('orange', 'orange', 300),
    ('pear', 'green', 150),
    ('watermelon', 'pink', 90)",
            'statement' =>
"SELECT name, colour, calories FROM fruit",
            'driver_options'   => array('PDO::ATTR_CASE' => 'PDO::CASE_UPPER'),
            'PDO::FETCH_OBJ',
        ],

        [
            'exec_statement' =>
"CREATE TABLE fruit
    (name, colour, calories INT);

INSERT INTO fruit VALUES
    ('apple', 'red', 150),
    ('banana', 'yellow', 250),
    ('kiwi', 'brown', 75),
    ('lemon', 'yellow', 25),
    ('orange', 'orange', 300),
    ('pear', 'green', 150),
    ('watermelon', 'pink', 90)",
            'statement' =>
"SELECT name, colour, calories
FROM fruit
WHERE calories <= :calories AND colour = :colour",
            'input_parameters' => array(':calories' => 150, ':colour' => 'red'),
            'PDO::FETCH_ASSOC',
        ],

        [
            'exec_statement' =>
"CREATE TABLE fruit
    (name, colour, calories INT);

INSERT INTO fruit VALUES
    ('apple', 'red', 150)",
            'statement' =>
"SELECT name, colour, calories
FROM fruit
WHERE calories 150 AND colour = 'red'",
            'driver_options'   => array('PDO::ATTR_CURSOR' => 'PDO::CURSOR_SCROLL'),
        ],
    ];

    public $input_args = ['driver_options', 'exec_statement', 'input_parameters', 'statement'];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:", null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $int = $pdo->exec(
            $exec_statement  // string $exec_statement
        );

        $pdostatement = $pdo->prepare(
            $statement, // string $statement,
            $driver_options // array $driver_options = array()
        );

        $bool = $pdostatement->execute(
            $input_parameters  // array $input_parameters
        );

        inject_function_call
    ';

    public $synopsis = 'public mixed PDOStatement::fetch ([ int $fetch_style [, int $cursor_orientation = PDO::FETCH_ORI_NEXT [, int $cursor_offset = 0 ]]] )';

    function pre_exec_function()
    {
        $pdo = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $statement = $this->_filter->filter_arg_value('exec_statement');
        $this->result['int'] = $pdo->exec($statement);

        if ($this->result['int'] === false) {
            $this->method_to_exec = false;
            return;
        }

        $statement = $this->_filter->filter_arg_value('statement');
        $driver_options = (array) $this->_filter->filter_arg_value('driver_options');

        if (! $this->result['pdostatement'] = $pdo->prepare($statement, $driver_options)) {
            // note: sqlite does not support scrolling cursors
            $this->method_to_exec = false;
            return;
        }

        if ($driver_options) {
            // forces the driver options that do not seem to be working as a param of prepare()
            pdo__prepare::fix_driver_options($pdo, $driver_options);
        }

        $this->object = $this->result['pdostatement'];
        $this->result['pdostatement'] = get_class($this->object);
        $input_parameters = $this->_filter->filter_arg_value('input_parameters');

        if (! $this->result['bool'] = $this->object->execute($input_parameters)) {
            $this->method_to_exec = false;
            return;
        }
    }
}
