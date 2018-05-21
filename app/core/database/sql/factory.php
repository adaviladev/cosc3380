<?php

/**
 * This script will fill the database with
 * the dummy data found in the SQL files
 * in this directory.
 *
 * To run, SSH into your VM, navigate to
 * ~/Code/cosc3380/core/database/sql
 * and run the following command
 *
 * php factory.php
 */

use App\Core\App;
use App\Core\Database\Connection;
use App\Core\Database\QueryBuilder;

// require __DIR__ . '/../../App.php';
// require __DIR__ . '/../Connection.php';
// require __DIR__ . '/../QueryBuilder.php';

App::bind('config', require __DIR__ . '/../../config.php');
try {
    App::bind('database', new QueryBuilder(Connection::make(App::get('config')['database'])));
} catch (Exception $e) {
    echo $e->getMessage();
}

$seeders = [];
$seeders['seeder'] = file_get_contents(__DIR__ . '/seeder.sql');
$seeders['roles'] = file_get_contents(__DIR__ . '/rolesSeeder.sql');
$seeders['states'] = file_get_contents(__DIR__ . '/statesSeeder.sql');
$seeders['postOffices'] = file_get_contents(__DIR__ . '/postOfficesSeeder.sql');
$seeders['packageStatus '] = file_get_contents(__DIR__ . '/packageStatusSeeder.sql');
$seeders['packageType'] = file_get_contents(__DIR__ . '/packageTypeSeeder.sql');
$seeders['addresses'] = file_get_contents(__DIR__ . '/addressesSeeder.sql');
$seeders['users'] = file_get_contents(__DIR__ . '/usersSeeder.sql');
$seeders['packages'] = file_get_contents(__DIR__ . '/packagesSeeder.sql');
$seeders['transactions'] = file_get_contents(__DIR__ . '/transactionsSeeder.sql'); //

foreach ($seeders as $file => $contents) {
    try {
        App::get('database')
           ->run($contents, true);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    echo $file . "SQL executed\n";
}
