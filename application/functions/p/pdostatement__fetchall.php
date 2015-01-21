<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'functions/p/pdostatement__fetch.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class pdostatement__fetchall extends pdostatement__fetch
{
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
"SELECT name, colour FROM fruit",
            'driver_options' => array('PDO::ATTR_CASE' => 'PDO::CASE_UPPER'),
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
"SELECT name, colour FROM fruit",
            'PDO::FETCH_COLUMN',
            0,
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
    ('watermelon', 'pink', 90),
    ('apple', 'green', 150),
    ('pear', 'yellow', 150)",
            'statement' =>
"SELECT name, colour FROM fruit",
            'PDO::FETCH_COLUMN | PDO::FETCH_GROUP',
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
"SELECT name, colour FROM fruit",
            'PDO::FETCH_CLASS',
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
"SELECT name, colour FROM fruit",
            'PDO::FETCH_FUNC',
            'fruit',
        ],
    ];

    public $source_code = '
        // custom callback function
        function fruit($name, $colour) {
            return "{$name}: {$colour}";
        }

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

    public $synopsis = 'public array PDOStatement::fetchAll ([ int $fetch_style [, mixed $fetch_argument [, array $ctor_args = array() ]]] )';

    function pre_exec_function()
    {
        if ($this->_filter->filter_arg_value('fetch_style') === PDO::FETCH_FUNC) {
            $this->_filter->filter_callback('fetch_argument');
        }

        parent::pre_exec_function();
    }
}
