<?php

namespace App\Core\Database;


use App\Core\App;

class Schema
{
    protected static $operation;
    protected static $fields;

    /** @var QueryBuilder */
    private static $queryBuilder;
    protected static $blueprint;
    protected static $table;

    private static function init(): void
    {
        if (!self::$queryBuilder) {
            self::$queryBuilder = App::get('database');
        }
    }

    public static function create($tableName, callable $callback): void
    {
        self::$table = $tableName;
        self::$operation = 'CREATE TABLE';
        self::$blueprint = new Blueprint;
        $callback(self::$blueprint);
        self::$fields = implode(', ', self::$blueprint->fields);
    }

    public static function dropIfExists($table): void
    {
        self::run("DROP TABLE IF EXISTS `{$table}`;");
    }

    public static function run($sql): void
    {
        self::$queryBuilder->run($sql);
    }

    public static function toSql(): string
    {
        $operation = self::$operation;
        $table = self::$table;
        $fields = self::$fields;

        return "{$operation} `{$table}` ({$fields});";
    }

    public static function __callStatic($name, $arguments)
    {
        echo "called statically\n";
        self::init();
    }
}