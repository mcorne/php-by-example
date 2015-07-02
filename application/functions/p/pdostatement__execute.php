<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

/**
 * Function configuration
 *
 * @see docs/function-configuration.txt
 */

class pdostatement__execute extends function_core
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
            'statement'      => "SELECT name, colour, calories FROM fruit",
        ],
        [
            'exec_statement'   =>
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
            'statement'        =>
                "SELECT name, colour, calories
                FROM fruit
                WHERE calories <= :calories AND colour = :colour",
            array(':calories' => 150, ':colour' => 'red'),
        ],
        [
            'exec_statement'   =>
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
            'statement'        =>
                "SELECT name, colour, calories
                FROM fruit
                WHERE calories <= ? AND colour = ?",
            array(150, 'red'),
        ],
    ];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:", null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $int = $pdo->exec(
            $exec_statement  // string $exec_statement
        );

        $pdostatement = $pdo->prepare(
            $statement, // string $statement,
            $driver_options // array $driver_options = array()
        );

        inject_function_call
    ';

    public $input_args = ['exec_statement', 'statement'];

    public $synopsis = 'public bool PDOStatement::execute ([ array $input_parameters ] )';

    function pre_exec_function()
    {
        $this->object_name = 'pdostatement';

        $this->result['pdo'] = $pdo = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
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

        $this->object = $this->result['pdostatement'];
    }
}
