<?php
/**
 * PHP By Example
 *
 * @copyright 2015 Michel Corne
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'models/function_core.php';

class pdo__prepare extends function_core
{
    public $constant_prefix = ['fetch_style' => 'PDO::FETCH'];

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
"SELECT name, colour, calories
FROM fruit
WHERE calories <= :calories AND colour = :colour",
            'input_parameters' => array(':calories' => 150, ':colour' => 'red'),
            'fetch_style' => 'PDO::FETCH_ASSOC',
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
"SELECT name, colour, calories
FROM fruit
WHERE calories < ? AND colour = ?",
            'input_parameters' => array(175, 'yellow'),
            'fetch_style' => 'PDO::FETCH_ASSOC',
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
"SELECT name, colour, calories
FROM fruit
WHERE calories < ? AND colour = ?",
            array('PDO::ATTR_CASE' => 'PDO::CASE_UPPER'),
            'input_parameters' => array(175, 'yellow'),
            'fetch_style' => 'PDO::FETCH_ASSOC',
        ],
    ];

    public $input_args = ['exec_statement', 'input_parameters'];

    public $source_code = '
        $pdo = new PDO("sqlite::memory:", null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $int = $pdo->exec(
            $exec_statement  // string $exec_statement
        );

        inject_function_call

        // shows the query result
        $bool = $PDOStatement->execute(
            $input_parameters  // array $input_parameters
        );
        $rows = $PDOStatement->fetchAll(
            $fetch_style  // int $fetch_style
        );
    ';

    public $synopsis = 'public PDOStatement PDO::prepare ( string $statement [, array $driver_options = array() ] )';

    function fix_driver_options($driver_options)
    {
        if (! is_array($driver_options)) {
            return;
        }

        foreach ($driver_options as $key => $value) {
            if (is_int($key) and is_int($value)) {
                $this->object->setAttribute($key, $value);
            }
        }
    }

    function post_exec_function()
    {
        if ($statement = $this->result['PDOStatement']) {
            $this->result['PDOStatement'] = get_class($statement);
            $input_parameters = $this->_filter->filter_arg_value('input_parameters');

            if ($this->result['bool'] = $statement->execute($input_parameters)) {
                $fetch_style = $this->_filter->filter_arg_value('fetch_style');
                $this->result['rows'] = $statement->fetchAll($fetch_style);
            }
        }
    }

    function pre_exec_function()
    {
        $this->object = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $statement = $this->_filter->filter_arg_value('exec_statement');
        $this->result['int'] = $this->object->exec($statement);

        if ($driver_options = $this->_filter->filter_arg_value('driver_options')) {
            // forces the driver options that do not seem to be working as a param of exectute()
            $this->fix_driver_options($driver_options);
        }
    }
}
