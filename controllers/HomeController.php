<?php

	namespace App\Controllers;

	use App\Core\App;
	use App\Core\Auth;

	class HomeController {
		public function home() {
			// die( var_dump( Auth::user() ) );
			$user = Auth::user();
			// var_dump( $user );
			if( $user ) {
				$user['packages'] = App::get('database')->findAll(
					'packages',
					[
						'userId' => $user['id']
					],
					'Package'
				);
				// var_dump( $user );
			}
			// var_dump($user);

			return view( 'dashboard' , compact( 'user' ) );
		}

		public function showPackages() {
		}
	}