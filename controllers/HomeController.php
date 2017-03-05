<?php

	namespace App\Controllers;

	use App\Core\App;
	use App\Core\Auth;

	class HomeController {
		public function home() {
			$user = Auth::user();
			if( $user ) {
				$user->packages = App::get('database')->findAll(
					'packages',
					[
						'userId' => $user->id
					],
					'Package'
				);
			}

			return view( 'dashboard' , compact( 'user' ) );
		}

		public function showPackages() {
		}
	}