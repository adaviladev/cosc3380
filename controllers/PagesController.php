<?php

	namespace App\Controllers;

	use App\Core\App;

	class PagesController {
		public function home() {
			$users = App::get( 'database' )->selectAll( 'users' );
			var_dump( $_SESSION );

			return view( 'index' );
		}

		public function about() {

			return view( 'pages/about' );
		}

		public function contact() {

			return view( 'pages/contact' );
		}
	}