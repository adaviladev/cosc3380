<?php

namespace App\Core\Database;


use App\Core\App;

class Schema
{
    private static $queryBuilder;

    private static function init(): void
    {
        if (!self::$queryBuilder) {
            self::$queryBuilder = App::get('database');
        }
    }

    public static function create($tableName, callable $callback): void
    {
        self::init();

        $blueprint = new Blueprint;
        $callback($blueprint);
        $fields = implode(', ', $blueprint->fields);
        $sql = "CREATE TABLE `$tableName` ($fields);";

        self::run($sql);
    }

    private static function run($sql)
    {
        self::$queryBuilder->run($sql);
    }
}