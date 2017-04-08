<?php

	/**
	 * This script will query the database at regular
	 * intervals to update the status of packages
	 * for alerting the user
	 */

	use App\Core\App;

	require '/var/www/prostoffice/core/App.php';
	require '/var/www/prostoffice/core/database/Connection.php';
	require '/var/www/prostoffice/core/database/QueryBuilder.php';
	require '/var/www/prostoffice/core/Model.php';
	require '/var/www/prostoffice/core/classes/User.php';
	require '/var/www/prostoffice/core/classes/Package.php';
	require '/var/www/prostoffice/core/classes/PackageStatus.php';

	App::bind( 'config' , require '/var/www/prostoffice/core/config.php' );
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


	$fp = fopen('./data.txt', 'w');
	fwrite($fp, 'hit');
	fclose($fp);