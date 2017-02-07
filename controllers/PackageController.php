<?php

	namespace App\Controllers;

	use App\Core\App;

	class PackageController {
		public function show(){
			$packages = App::get( 'database' )->selectAll( 'packages', 'Package' );

			foreach( $packages as $package ) {
				$package->user = App::get( 'database' )
					->find(
						'users',
						[
							'id' => $package->user_id
						],
						'User'
					);
			}
			return view( 'packages' , compact( 'packages' ) );
		}

		public function packageDetail( $packageId ){
			var_dump( $packageId );
		}
	}