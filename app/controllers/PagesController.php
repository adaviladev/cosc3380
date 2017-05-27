<?php
	namespace App\Controllers;
	use PostOffice;
	use State;
	class PagesController {
		/**
		 * @return mixed Display static home page
		 */
		public function home() {
			return view( 'index' );
		}
		/**
		 * @return mixed Display static About page
		 */
		public function about() {
			return view( 'pages/about' );
		}
		/**
		 * @return mixed Display static Contact page
		 */
		public function contact() {
			$postOffices = PostOffice::selectAll();
			foreach( $postOffices as $postOffice ) {
				$postOffice->state = State::find()
				                          ->where( [ 'id' ] , [ '=' ] , [ $postOffice->stateId ] )
				                          ->get()->state;
			}
			return view( 'pages/contact', compact('postOffices') );
		}
		/**
		 * @return mixed Display static Locations page
		 */
		public function locations() {
			$postOffices = PostOffice::selectAll();
			foreach( $postOffices as $postOffice ) {
				$postOffice->state = State::find()
				                          ->where( [ 'id' ] , [ '=' ] , [ $postOffice->stateId ] )
				                          ->get()->state;
			}
			return view( 'pages/locations' , compact( 'postOffices' ) );
		}
		public function  handleContactForm(){
			// dd( $_POST );
			$postOffices = PostOffice::selectAll();
			if(isset($_POST['email'])){
				$to = ""; // this is your Email address
				$from = $_POST['email']; // this is the sender's Email address
				$first_name = $_POST['firstName'];
				$last_name = $_POST['lastName'];
				$subject = "Form submission";
				$message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
				$headers = "From:" . $from;
				$emailStatus = mail($to,$subject,$message,$headers);
				if( $emailStatus ) {
					return view( 'pages/contact' , compact('postOffices' , 'emailStatus' ) );
				}
				// echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
				return view( 'pages/contact' , compact('postOffices' , 'emailStatus' ) );
			}
			return view( 'pages/contact' , compact('postOffices' ) );
		}
		/**
		 * @return mixed Display static Errors page
		 */
		public function error() {
			return view( 'error/404' );
		}
	}