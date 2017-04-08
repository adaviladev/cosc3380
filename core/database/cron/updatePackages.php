<?php

	/**
	 * This script will query the database at regular
	 * intervals to update the status of packages
	 * for alerting the user
	 */

	use App\Core\App;

	require '../../App.php';
	require '../Connection.php';
	require '../QueryBuilder.php';
	require '../../Model.php';
	require '../../classes/User.php';
	require '../../classes/Package.php';
	require '../../classes/PackageStatus.php';

	App::bind( 'config' , require '../../config.php' );
	App::bind( 'database' , new QueryBuilder( Connection::make( App::get( 'config' )[ 'database' ] ) ) );

	$enRoute = App::get( 'database' )
	              ->findAll( 'packages' , [ '*' ] , 'Package' )
	              ->where( [ 'packageStatus' ] , [ '=' ] , [ 2 ] )
	              ->get();

	$processing = App::get( 'database' )
	                 ->findAll( 'packages' , [ '*' ] , 'Package' )
	                 ->where( [ 'packageStatus' ] , [ '=' ] , [ 1 ] )
	                 ->get();

	var_dump( count( $enRoute ) );
	$ctr = 0;
	foreach( $enRoute as $package ) {
		$rand = rand( 1 , 10 );
		if( $rand <= 3 ) {
			var_dump( $package );
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
	var_dump( $ctr );
