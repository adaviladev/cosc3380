<?php

	namespace App\Controllers;

	use Address;
	use App\Core\App;
	use App\Core\Auth;
	use Package;

	class HomeController {
		public function home() {
			$user = Auth::user();
			if( $user ) {
				$user->packages = Package::findAll()
				                         ->where( [ 'userId' ] , [ '=' ] , [ $user->id ] )
				                         ->limit( 6 )
				                         ->orderBy( 'createdAt' , 'DESC' )
				                         ->get();
				foreach( $user->packages as $package ) {
					$package->destination   = Address::find()
					                                 ->where( [ 'id' ] , [ '=' ] , [ $package->destinationId ] )
					                                 ->get();
					$package->returnAddress = Address::find()
					                                 ->where( [ 'id' ] , [ '=' ] , [ $package->returnAddressId ] )
					                                 ->get();
				}
			}

			return view( 'dashboard/dashboard' , compact( 'user' ) );
		}

		public function showPackages() {
		}

	}