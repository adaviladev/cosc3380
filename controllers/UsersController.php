<?php

	namespace App\Controllers;

	use App\Core\App;

	class UsersController {
		public function show() {
			$users = App::get( 'database' )->selectAll( 'users' );

			var_dump( $users );
			// return view( 'index' , compact( 'users' ) );
		}

		public function userDetail( $userId ) {
			$user = App::get( 'database' )->find( 'users' ,
			                                      [
				                                      'id' => $userId
			                                      ] ,
			                                      'User' );
			var_dump( $user );
		}

		public function store() {
			App::get( 'database' )->insert( 'users' ,
			                                [
				                                'username' => $_POST[ 'username' ] ,
				                                'password' => md5( $_POST[ 'password' ] ) ,
				                                'role'     => 2
			                                ] );

			$users = App::get( 'database' )->selectAll( 'users' );
			var_dump( $users );
			// header( "Location: /home" );
		}
	}