<?php

	namespace App\Controllers;

	use App\Core\App;
	use App\Core\User;

	class AuthController {

		public function login(){
		    return view( 'auth/login' );
		}
		public function register(){
			$states = App::get( 'database' )->selectAll( 'states' );

		    return view( 'auth/register' , compact( 'states' ) );
		}

		public function addUser(){

			// $_POST['password'] = md5($_POST['password']);
		}

		public function signIn(){
		    $user = App::get('database')->find(
		    	"users",
			    [
			    	'email' => $_POST[ 'email' ],
				    'password' => $_POST[ 'password' ]
			    ],
			    'User'
		    );

		    var_dump( $user );
		    $_SESSION['user'] = serialize( $user );
		    $userObj =  unserialize( $_SESSION['user'] );
			var_dump( $_SESSION['user'] );
			var_dump( $userObj );

		    // redirect( 'dashboard' );
		}
	}