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

	require '../../App.php';
	require '../Connection.php';
	require '../QueryBuilder.php';

	App::bind( 'config' , require '../../config.php' );
	App::bind( 'database' , new QueryBuilder( Connection::make( App::get( 'config' )[ 'database' ] ) ) );

	$seeders                     = [];
	$seeders[ 'seeder' ]         = file_get_contents( 'seeder.sql' );
	$seeders[ 'roles' ]          = file_get_contents( 'rolesSeeder.sql' );
	$seeders[ 'states' ]         = file_get_contents( 'statesSeeder.sql' );
	$seeders[ 'packageStatus ' ] = file_get_contents( 'packageStatusSeeder.sql' );
	$seeders[ 'packageType' ]    = file_get_contents( 'packageTypeSeeder.sql' );
	$seeders[ 'addresses' ]      = file_get_contents( 'addressesSeeder.sql' );
	$seeders[ 'users' ]          = file_get_contents( 'usersSeeder.sql' );
	$seeders[ 'packages' ]       = file_get_contents( 'packagesSeeder.sql' );
	// $seeders[ 'transactions' ] = file_get_contents( 'transactionsSeeder.sql' );

	foreach( $seeders as $file => $contents ) {
		App::get( 'database' )->run( $contents , true );
		echo $file . "SQL executed\n";
	}
