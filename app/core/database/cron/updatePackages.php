<?php

	/**
	 * This script will query the database at regular
	 * intervals to update the status of packages
	 * for alerting the user
	 */

	use App\Core\App;

	require __DIR__ . '/../../bootstrap.php';

	$processing = Package::findAll()
	                     ->where( [ 'packageStatus' ] , [ '=' ] , [ 1 ] )
	                     ->get();

	$enRoute = Package::findAll()
	                  ->where( [ 'packageStatus' ] , [ '=' ] , [ 2 ] )
	                  ->get();

	$delivered = Package::findAll()
	                     ->where( [ 'packageStatus' ] , [ '=' ] , [ 3 ] )
	                     ->get();

	$cancelledList = Package::findAll()
	                        ->where( [ 'packageStatus' ] , [ '=' ] , [ 4 ] )
	                        ->get();

	/**
	 * Increment packageStatus property of packages collected above
	 */
	$ctr = 0;
	foreach( $processing as $package ) {
		$rand = rand( 1 , 10 );
		if( $rand <= 3 ) {
			// var_dump( $package );
			Package::update( [
				                 'packageStatus' => $package->packageStatus + 1
			                 ] )
			       ->where( [ 'id' ] , [ '=' ] , [ $package->id ] )
			       ->get();
			$ctr++;
		}
	}
	$ctr = 0;
	foreach( $enRoute as $package ) {
		$rand = rand( 1 , 10 );
		if( $rand <= 3 ) {
			Package::update( [
				                 'packageStatus' => $package->packageStatus + 1
			                 ] )
			       ->where( [ 'id' ] , [ '=' ] , [ $package->id ] )
			       ->get();
			$ctr++;
		}
	}
	$ctr = 0;
	foreach( $delivered as $package ) {
		$rand = rand( 1 , 10 );
		if( $rand <= 3 ) {
			Package::update( [
				                 'packageStatus' => $package->packageStatus + 1
			                 ] )
			       ->where( [ 'id' ] , [ '=' ] , [ $package->id ] )
			       ->get();
			$ctr++;
		}
	}
	$ctr = 0;
	foreach( $cancelledList as $package ) {
		$rand = rand( 1 , 10 );
		if( $rand <= 3 ) {
			Package::update( [
				                 'packageStatus' => 1
			                 ] )
			       ->where( [ 'id' ] , [ '=' ] , [ $package->id ] )
			       ->get();
			$ctr++;
		}
	}