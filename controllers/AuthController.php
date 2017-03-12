<?php

	namespace App\Controllers;

	use App\Core\App;
	use App\Core\Auth;
	use App\Core\User;

	class AuthController {

		public function login() {
			return view( 'auth/login' );
		}

		public function register() {
			$states = App::get( 'database' )->selectAll( 'states' );

			return view( 'auth/register' , compact( 'states' ) );
		}

		public function addUser() {
			// $_POST['password'] = md5($_POST['password']);
		}

		public function signIn() {
			$user = App::get( 'database' )->find( "users" ,
				[ '*' ] , 'User' )->where( [
				                     'email' ,
				                     'password'
			                     ] , [
				                     '=' ,
				                     '='
			                     ] , [
				                     $_POST[ 'email' ] ,
				                     md5($_POST[ 'password' ])
			                     ] )->get();

			if( $user ) {
				$_SESSION[ 'user' ] = serialize( $user );
				redirect( 'dashboard' );
			}

			return view( 'auth/login' , compact( 'user' ) );
		}

		public function logout() {
			if( isset( $_SESSION[ 'user' ] ) ) {
				unset( $_SESSION[ 'user' ] );
			}

			$_SESSION[ 'user' ] = false;

			redirect( '' );
		}
	}