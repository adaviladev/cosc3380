<?php

	namespace App\Controllers;

	use App\Core\App;

	class UsersController {
		public function show(){
			$users = App::get( 'database' )->selectAll( 'users' );

			return view( 'index' , compact( 'users' ) );
		}

		public function store(){
		    App::get('database')->insert( 'users', [
		    	'name' => $_POST[ 'name' ]
		    ]);

		    header( "Location: /users" );
		}
	}