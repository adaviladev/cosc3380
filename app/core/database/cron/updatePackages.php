<?php

	/**
	 * This script will query the database at regular
	 * intervals to update the status of packages
	 * for alerting the user
	 */

	use App\Core\App;

	require __DIR__ . '/../../../core/App.php';
	require __DIR__ . '/../../../core/database/Connection.php';
	require __DIR__ . '/../../../core/database/QueryBuilder.php';
	require __DIR__ . '/../../../core/Model.php';
	require __DIR__ . '/../../../core/classes/User.php';
	require __DIR__ . '/../../../core/classes/Package.php';
	require __DIR__ . '/../../../core/classes/PackageStatus.php';

	App::bind( 'config' , require __DIR__ . '/../../../core/config.php' );
	App::bind( 'database' , new QueryBuilder( Connection::make( App::get( 'config' )[ 'database' ] ) ) );

	$enRoute = App::get( 'database' )
	              ->findAll( 'packages' , [ '*' ] , 'Package' )
	              ->where( [ 'packageStatus' ] , [ '=' ] , [ 2 ] )
	              ->get();

	$processing = App::get( 'database' )
	                 ->findAll( 'packages' , [ '*' ] , 'Package' )
	                 ->where( [ 'packageStatus' ] , [ '=' ] , [ 1 ] )
	                 ->get();

	$ctr = 0;
	foreach( $enRoute as $package ) {
		$rand = rand( 1 , 10 );
		if( $rand <= 3 ) {
			App::get( 'database' )
			   ->update( 'packages' , [
				   'packageStatus' => $package->packageStatus + 1
			   ] )
			   ->where( [ 'id' ] , [ '=' ] , [ $package->id ] )
			   ->get();
			$ctr++;
		}
	}
	foreach( $processing as $package ) {
		$rand = rand( 1 , 10 );
		if( $rand <= 3 ) {
			// var_dump( $package );
			App::get( 'database' )
			   ->update( 'packages' , [
				   'packageStatus' => $package->packageStatus + 1
			   ] )
			   ->where( [ 'id' ] , [ '=' ] , [ $package->id ] )
			   ->get();
			$ctr++;
		}
	}