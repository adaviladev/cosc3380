<?php

	namespace App\Controllers;

	use App\Core\App;
	use PostOffice;

	class PagesController {
		public function home() {

			return view( 'index' );
		}

		public function about() {

			return view( 'pages/about' );
		}

		public function contact() {

			return view( 'pages/contact' );
		}

		public function locations(){
		    $postOffices = PostOffice::selectAll();

		    return view( 'pages/locations' , compact( 'postOffices' ) );
		}

		public function error() {

			return view( 'error/404' );
		}
	}