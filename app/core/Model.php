<?php

namespace App\Models;

use App\Core\App;
use App\Core\Database\Connection;
use PDO;
use PDOException;

abstract class Model
{

    private $TABLE_ARRAY = [
        'Address' => 'addresses',
        'Email' => 'emails',
        'Package' => 'packages',
        'PackageStatus' => 'packageStatus',
        'PackageType' => 'packageTypes',
        'PostOffice' => 'postOffices',
        'Role' => 'roles',
        'State' => 'states',
        'Transaction' => 'transactions',
        'User' => 'users'
    ];


    /**
     * @var \PDO $builder
     */
    public $builder;
    // protected $table;

    protected $isSingle = false;
    protected $isUpdate = false;
    protected $query = '';
    protected $table = '';
    protected $type = '';
    protected $set = '';
    protected $whereClause = '';
    protected $orderBy = '';
    protected $limitTo = '';
    protected $onDelete = '';
    protected $class = 'stdClass';

    /**
     * @return static
     */
    private static function init()
    {
        $instance = new static;
        $instance->builder = Connection::make(App::get('config')['database']);

        return $instance;
    }

    /**
     * @param array $columns contains the columns to return
     *
     * @return array
     */
    public static function selectAll(array $columns = ['*']): array
    {
        /**
         * call init() from mandatory first calls and assign params to return of init()'s $instance
         */
        $instance = self::init();
        $class = static::class;
        $table = $instance->TABLE_ARRAY[$class];
        $instance->table = $table;

        $columnFields = implode(',', $columns);
        $statement = $instance->builder->query("select {$columnFields} from {$table}");

        return $statement->fetchAll(PDO::FETCH_CLASS, $class);
    }

    /**
     * @param string $joinedTable table to be joined on
     * @param string $foreignKey  correlating key in table from calling class: TABLE_ARRAY[ ::class => table ]
     * @param string $primaryKey  primary key in joined table
     * @param array  $columns     array of columns to be returned.
     *
     * @return Model
     *
     * I was playing around with this, but couldn't
     * figure out how to generalize it further
     * to work on multiple cases
     */
    public static function leftJoinOn($joinedTable, $foreignKey, $primaryKey, array $columns = ['*']): Model
    {
        $instance = self::init();
        $class = static::class;
        $table = $instance->TABLE_ARRAY[$class];
        $instance->table = $table;

        $columnFields = implode(', ', $columns);
        $instance->type = "SELECT {$columnFields} FROM {$table} JOIN {$joinedTable} ON (`{$table}`.`{$foreignKey}`=`{$joinedTable}`.`{$primaryKey}`)";

        return $instance;
    }

    /**
     * @param array $columns contains the columns to return
     *
     * @return object $instance object for further chaining
     */
    public static function find(array $columns = ['*'])
    {
        $instance = self::init();
        $class = static::class;
        $table = $instance->TABLE_ARRAY[$class];
        $instance->table = $table;

        $columnFields = implode(',', $columns);
        $instance->type = "SELECT {$columnFields} FROM {$table}";
        $instance->class = $class;
        $instance->isSingle = true;

        return $instance;
    }

    /**
     * @param array $columns contains columns to retrieve
     *
     * @return $this same object for further chaining
     */
    public static function findAll(array $columns = ['*']): self
    {
        $instance = self::init();
        $class = static::class;
        $table = $instance->TABLE_ARRAY[static::class];
        $instance->table = $table;
        $columnFields = implode(',', $columns);
        $instance->type = "SELECT {$columnFields} FROM {$table}";
        $instance->class = $class;
        $instance->isSingle = false;

        return $instance;
    }

    /**
     * @param array  $columns   contains columns to check against
     * @param array  $operators contains matching set of operators for each check
     * @param array  $values    contains matching set of values to check for
     * @param string $bool      conjunction to use between conditional checks
     *
     * @return $this same object for further chaining
     */
    public function where(array $columns = [], array $operators = [], array $values = [], $bool = ' AND '): self
    {
        if (empty($columns) || empty($operators) || empty($values)) {
            return $this;
        }
        $this->whereClause = 'WHERE ';
        $count = \count($columns);
        for ($i = 0; $i < $count; $i++) {
            if ($i > 0) {
                $this->whereClause .= $bool;
            }
            $this->whereClause .= "`{$this->table}`.`" . $columns[$i] . '`' . $operators[$i] . "'" . $values[$i] . "'";
        }

        return $this;
    }

    /**
     * @param array  $values list of values to be matched against
     * @param string $column name of column to match against $values[]
     *
     * @return $this same object for further chaining
     */
    public function whereIn(array $values = [], $column = 'id'): self
    {
        $valueFields = implode(',', $values);
        $this->whereClause = "WHERE {$column} IN ({$valueFields})";

        return $this;
    }

    public function limit($quantity)
    {
        $this->limitTo = "LIMIT {$quantity}";

        return $this;
    }

    /**
     * @param $attribute
     * @param $direction
     *
     * @return $this same object for further chaining
     */
    public function orderBy($attribute, $direction): self
    {
        $this->orderBy .= "ORDER BY {$attribute} {$direction}";

        return $this;
    }

    /**
     * @param array $parameters $key => value pairs to insert
     *
     * @return int value of last inserted ID
     */
    public static function insert(array $parameters = []): ?int
    {
        $instance = self::init();
        $class = static::class;
        $table = $instance->TABLE_ARRAY[$class];
        array_keys($parameters);
        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)', $table, implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters)));

        try {
            $statement = $instance->builder->prepare($sql);
            $statement->execute($parameters);

            return (int)$instance->builder->lastInsertId();
        } catch (PDOException $e) {
            return $e->getCode();
        }
    }

    /**
     * @param array $bindings key=>value pairs of columns and values to update
     *
     * @return Model $instance
     */
    public static function update(array $bindings = []): Model
    {
        $instance = self::init();
        $class = static::class;
        $table = $instance->TABLE_ARRAY[$class];
        $instance->type = "UPDATE {$table}";
        $instance->set = 'SET ';
        $instance->isUpdate = true;
        $ctr = 0;

        foreach ($bindings as $attr => $value) {
            if ($ctr > 0) {
                $instance->set .= ', ';
            }
            $instance->set .= "{$attr}='{$value}'";
            $ctr++;
        }

        return $instance;
    }

    /**
     * Construct the SQL query based off of previous calls
     * @return array|mixed
     */
    public function get()
    {

        $this->query = $this->type;
        if ($this->set !== '') {
            $this->query .= ' ' . $this->set;
        }
        if ($this->whereClause !== '') {
            $this->query .= ' ' . $this->whereClause;
        }
        if ($this->orderBy !== '') {
            $this->query .= ' ' . $this->orderBy;
        }
        if ($this->limitTo !== '') {
            $this->query .= ' ' . $this->limitTo;
        }

        // dd( "{$this->query}\n" );
        return $this->run($this->query);
    }

    /**
     * @param string $sql Raw/generated sql query to be immediately executed
     *
     * @return array|bool|object
     */
    public function run($sql)
    {
        try {
            $statement = $this->builder->query($sql);
            if (!$this->isUpdate) {
                if ($this->isSingle) {
                    return $statement->fetchObject($this->class);
                }

                return $statement->fetchAll(PDO::FETCH_CLASS, $this->class);
            }
        } catch (PDOException $e) {
            die($e);
        }
        return false;
    }

    public static function lastInsertId(): string
    {
        $instance = self::init();

        return $instance->builder->lastInsertId();
    }

    abstract public function hydrate();
}