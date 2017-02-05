<?php

	namespace App\Controllers;

	use App\Core\App;
	use Auth;

	class HomeController {
		public function home() {
			$user = Auth::user();
			if( $user ) {
				$user->packages = App::get('database')->findAll(
					'packages',
					[
						'user_id' => $user->id
					],
					'Package'
				);
				// var_dump( $user );
			}

			return view( 'home' , compact( 'user' ) );
		}

		public function showPackages() {
		}
	}