<?php

	/**
	 * This script will query the database at regular
	 * intervals to alert users when the status
	 * of their package has changed
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

	$alerts = App::get( 'database' )
	             ->findAll( 'emails' )
	             ->where( [ 'sent' ] , [ '=' ] , [ 0 ] )
	             ->get();

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
		// $to        = "archangel89gtr@yahoo.com";
		// $subject   = "Status of Package #{$alert->package->id} Updated";
		// $message   = "The status of your order has been updated to: {$alert->package->status}";
		// $headers   = "From: no-reply@prostoffice.pro";
		// $emailSent = mail( $to , $subject , $message , $headers );
		// // $emailSent = true;
		// if( $emailSent ) {
		// 	App::get( 'database' )
		// 	   ->update( 'emails' , [
		// 	   	'sent' => 1
		// 	   ])
		// 	   ->where( ['userId','packageId','sent'] , ['=','=','='] , [$alert->userId, $alert->packageId, $alert->sent])
		// 	   ->get( true );
		// }
	}
