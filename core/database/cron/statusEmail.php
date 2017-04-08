<?php

	/**
	 * This script will query the database at regular
	 * intervals to alert users when the status
	 * of their package has changed
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

	$alerts = App::get( 'database' )
	             ->findAll( 'emails' )
	             ->where( [ 'sent' ] , [ '=' ] , [ 0 ] )
	             ->get();
	var_dump( $alerts );

	foreach( $alerts as $alert ) {
		$alert->user            = App::get( 'database' )
		                             ->find( 'users' , [ '*' ] , 'User' )
		                             ->where( [ 'id' ] , [ '=' ] , [ $alert->userId ] )
		                             ->get();
		$alert->package         = App::get( 'database' )
		                             ->find( 'packages' , [ '*' ] , 'Package' )
		                             ->where( [ 'id' ] , [ '=' ] , [ $alert->packageId ] )
		                             ->get();
		$alert->package->status = App::get( 'database' )
		                             ->find( 'packageStatus' , [ '*' ] , 'PackageStatus' )
		                             ->where( [ 'id' ] , [ '=' ] , [ $alert->package->packageStatus ] )
		                             ->get()->type;
		// $to                     = $alert->user->email;
		$to        = "archangel89gtr@yahoo.com";
		$subject   = "Status of Package #{$alert->package->id} Updated";
		$message   = "The status of your order has been updated to: {$alert->package->status}";
		$headers   = "From: no-reply@prostoffice.pro";
		$emailSent = mail( $to , $subject , $message , $headers );
		// $emailSent = true;
		if( $emailSent ) {
			App::get( 'database' )
			   ->update( 'emails' , [
			   	'sent' => 1
			   ])
			   ->where( ['userId','packageId','sent'] , ['=','=','='] , [$alert->userId, $alert->packageId, $alert->sent])
			   ->get( true );
		}
	}

	var_dump( $alerts );

