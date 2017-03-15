<?php

	namespace App\Controllers;

	use App\Core\App;
	use App\Core\Auth;
	use Package;

	class HomeController {
		public function home() {
			$user = Auth::user();
			if( $user ) {
				$user->packages = Package::findAll()
				                         ->where( [ 'userId' ] ,
				                                  [ '=' ] ,
				                                  [ $user->id ] )
				                         ->get();
			}

			return view( 'dashboard' ,
			             compact( 'user' ) );
		}

		public function showPackages() {
		}
	}