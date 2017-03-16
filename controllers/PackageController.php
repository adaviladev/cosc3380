<?php

	namespace App\Controllers;

	use Address;
	use App\Core\App;
	use App\Core\Auth;
	use Package;
	use User;

	class PackageController {

		public function postOfficeInventory() {
			$user = Auth::user();
			if( $user ) {
				$packages = Package::findAll()
				                   ->where( [ 'postOfficeId' ] , [ '=' ] , [ $user->postOfficeId ] )
				                   ->get();
				foreach( $packages as $package ) {
					$package->user = User::find()
					                     ->where( [ 'id' ] , [ '=' ] , [ $package->userId ] )
					                     ->get();
				}

				return view( 'packages/packages' , compact( 'packages' ) );
			}

			return redirect( 'login' );
		}

		public function show() {
			$packages = Package::selectAll();

			foreach( $packages as $package ) {
				$package->user          = User::find( $package->userId )
				                              ->get();
				$package->destination   = Address::find( $package->destinationId )
				                                 ->get();
				$package->returnAddress = Address::find( $package->returnAddressId )
				                                 ->get();
			}

			return view( 'packages/packages' , compact( 'packages' ) );
		}

		public function packageDetail( $packageId ) {
			$package = Package::find()
			                  ->where( [ 'id' ] , [ '=' ] , [ $packageId ] )
			                  ->get();

			$package->user = User::find()
			                     ->where( [ 'id' ],[ '=' ],[ $package->userId ])
			                     ->get();

			return view( 'packages/packageDetail' , compact( 'package' ) );
		}
	}