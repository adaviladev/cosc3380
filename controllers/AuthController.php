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

			$_POST['password'] = md5($_POST['password']);
		}

		public function signIn(){
		    $user = App::get('database')->find(
		    	"users",
			    [
			    	'username' => $_POST[ 'username' ],
				    'password' => $_POST[ 'password' ]
			    ],
			    'User'
		    );
		    $_SESSION['user'] = $user;
			var_dump($user);
			var_dump($_SESSION);

		    header( 'Location: /home' );
		}
	}