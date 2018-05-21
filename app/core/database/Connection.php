<?php

namespace App\Core\Database;

class Connection
{
    /**
     * @param $config
     * @return \PDO
     */
    public static function make($config): \PDO
    {
        try {
            return new \PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    }
}