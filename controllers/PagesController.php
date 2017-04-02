<?php

	namespace App\Controllers;

	use App\Core\App;
	use PostOffice;
	use State;

	class PagesController {
		public function home() {

			return view( 'index' );
		}

		public function about() {

			return view( 'pages/about' );
		}

		public function contact() {
			$postOffices = PostOffice::selectAll();
			foreach( $postOffices as $postOffice ) {
				$postOffice->state = State::find()
				                          ->where( [ 'id' ] , [ '=' ] , [ $postOffice->stateId ] )
				                          ->get()->state;
			}

			return view( 'pages/contact', compact('postOffices') );
		}

		public function locations() {
			$postOffices = PostOffice::selectAll();
			foreach( $postOffices as $postOffice ) {
				$postOffice->state = State::find()
				                          ->where( [ 'id' ] , [ '=' ] , [ $postOffice->stateId ] )
				                          ->get()->state;
			}

			return view( 'pages/locations' , compact( 'postOffices' ) );
		}

		public function error() {

			return view( 'error/404' );
		}
	}