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

class pdo__errorcode extends function_core
{
    public $examples = [
        [
            'exec_statement' => "INSERT INTO bones(skull) VALUES ('lucy')",
        ],
        [
            'exec_statement' => "bogus sql",
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
        ],
    ];

    public $input_args = ['exec_statement'];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:");
        $int = $pdo->exec(
            $exec_statement  // string $exec_statement
        );

        inject_function_call
    ';

    public $synopsis = 'public mixed PDO::errorCode ( void )';

    function pre_exec_function()
    {
        $this->result['pdo'] = $this->object = new PDO('sqlite::memory:');
        $statement = $this->_filter->filter_arg_value('exec_statement');
        $this->result['int'] = $this->object->exec($statement);
    }
}
