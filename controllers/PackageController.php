<?php

	namespace App\Controllers;

	use App\Core\App;
	use App\Core\Auth;

	class PackageController {

		public function postOfficeInventory() {
			$user = Auth::user();
			if( $user ) {
				$packages = App::get( 'database' )
				               ->findAll( 'packages' , [ '*' ] , 'Package' )
				               ->where( [ 'postOfficeId' ] , [ '=' ] , [ $user->postOfficeId ] )
				               ->get();
				foreach( $packages as $package ) {
					$package->user = App::get( 'database' )
					                    ->find( 'users' , [ '*' ] , 'User' )
					                    ->where( [ 'id' ] , [ '=' ] , $package->userId )
					                    ->get();
				}

				return view( 'packages/packages' , compact( 'packages' ) );
			}

			return redirect( 'login' );
		}

		public function show() {
			$packages = App::get( 'database' )
			               ->selectAll( 'packages' , [ '*' ] , 'Package' );

			foreach( $packages as $package ) {
				$package->user          = App::get( 'database' )
				                             ->find( 'users' , [ '*' ] , 'User' )
				                             ->where( [ 'id' ] , [ '=' ] , [ $package->userId ] )
				                             ->get();
				$package->destination   = App::get( 'database' )
				                             ->find( 'addresses' , [ '*' ] , 'Address' )
				                             ->where( [ 'id' ] , [ '=' ] , [ $package->destinationId ] )
				                             ->get();
				$package->returnAddress = App::get( 'database' )
				                             ->find( 'addresses' , [ '*' ] , 'Address' )
				                             ->where( [ 'id' ] , [ '=' ] , [ $package->returnAddressId ] )
				                             ->get();
			}

			return view( 'packages/packages' , compact( 'packages' ) );
		}

		public function packageDetail( $packageId ) {
			$package = App::get( 'database' )
			              ->find( 'packages' , [
				              '*'
			              ] , 'Package' )
			              ->where( [ 'id' ] , [ '=' ] , [ $packageId ] )
			              ->get();

			$package->user = App::get( 'database' )
			                    ->find( 'users' , [
				                    '*'
			                    ] , 'User' )
			                    ->where( [ 'id' ] , [ '=' ] , [ $package->userId ] )
			                    ->get();

			return view( 'packages/packageDetail' , compact( 'package' ) );
		}
	}