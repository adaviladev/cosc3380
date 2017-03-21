<?php

	namespace App\Controllers;

	use Address;
	use App\Core\App;
	use App\Core\Auth;
	use Package;
	use User;

	class HomeController {
		public function home() {
			$user = Auth::user();
			if( $user ) {
				$packages = Package::findAll()
				                   ->where( [ 'postOfficeId' ] ,
				                            [ '=' ] ,
				                            [ $user->postOfficeId ] )
				                   ->limit( 6 )
				                   ->orderBy( 'createdAt' ,
				                              'DESC' )
				                   ->get();
				foreach( $packages as $package ) {
					$package->destination   = Address::find()
					                                 ->where( [ 'id' ] ,
					                                          [ '=' ] ,
					                                          [ $package->destinationId ] )
					                                 ->get();
					$package->returnAddress = Address::find()
					                                 ->where( [ 'id' ] ,
					                                          [ '=' ] ,
					                                          [ $package->returnAddressId ] )
					                                 ->get();
				}

				$employees = User::findAll()
				                 ->where(['postOfficeId','roleId'],['=','='],[ $user->postOfficeId, $user->roleId ])
				                 ->get();

				$customers = User::findAll()
				                 ->where(['roleId'],['>'],[ $user->roleId ])
				                 ->get();
				dd( $customers );
			}

			return view( 'dashboard/dashboard' ,
			             compact( 'user' , 'packages', 'employees', 'customers' ) );
		}

		public function showPackages() {
		}

	}