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

class pdostatement__columncount extends function_core
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
    ];

    public $input_args = ['exec_statement', 'statement'];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:", null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $count = $pdo->exec(
            $exec_statement  // string $exec_statement
        );
        $pdostatement = $pdo->query(
            $statement // string $statement
        );

        inject_function_call
    ';

    public $synopsis = 'public int PDOStatement::columnCount ( void )';

    function pre_exec_function()
    {
        $this->object_name = 'pdostatement';

        $this->result['pdo'] = $pdo = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $statement = $this->_filter->filter_arg_value('exec_statement');
        $this->result['count'] = $pdo->exec($statement);

        if ($this->result['count'] === false) {
            $this->method_to_exec = false;
            return;
        }

        $statement = $this->_filter->filter_arg_value('statement');

        if (! $this->result['pdostatement'] = $pdo->query($statement)) {
            $this->method_to_exec = false;
            return;
        }

        $this->object = $this->result['pdostatement'];
    }
}
