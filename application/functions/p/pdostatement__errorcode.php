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
 * Changes to this class may affect other classes.
 *
 * @see docs/function-configuration.txt
 */

class pdostatement__errorcode extends function_core
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
            'statement'      => "INSERT INTO bones(skull) VALUES ('lucy')",
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
            'statement'      => "bogus sql",
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
            'statement'      => "SELECT name, colour, calories FROM fruit",
        ],
    ];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:");
        $int = $pdo->exec(
            $exec_statement  // string $exec_statement
        );

        $pdostatement = $pdo->prepare(
            $statement, // string $statement,
            $driver_options // array $driver_options = array()
        );

        $bool = $pdostatement->execute(
            $input_parameters // array $input_parameters
        );

        inject_function_call

        // note that the PDOStatement object is actually not created on error!
    ';

    public $input_args = ['driver_options', 'exec_statement', 'statement'];

    public $synopsis = 'public string PDOStatement::errorCode ( void )';

    function pre_exec_function()
    {
        $this->object_name = 'pdostatement';

        $this->result['pdo'] = $pdo = new PDO('sqlite::memory:');
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

        $input_parameters = (array) $this->_filter->filter_arg_value('input_parameters');

        if (! $this->result['bool'] = $this->object->execute($input_parameters)) {
            return;
        }
    }
}
