<?php

	namespace App\Controllers;

	use App\Core\App;

	class UsersController {
		public function show() {
			$users = App::get( 'database' )->selectAll( 'users' );

			// var_dump( $users );
			return view( 'index' , compact( 'users' ) );
		}

		public function userDetail( $userId ) {
			$user = App::get( 'database' )->find( 'users' , [
				'id' => $userId
			] , 'User' );
			var_dump( $user );
		}

		public function store() {
			var_dump( $_POST );

			$password = md5( $_POST[ 'password' ] );
			App::get( 'database' )->insert( 'addresses' , [
				'street'     => $_POST[ 'address' ] ,
				'city'       => $_POST[ 'city' ] ,
				'stateId'    => $_POST[ 'state' ] ,
				'zipCode'    => $_POST[ 'zipCode' ] ,
				'createdAt'  => date( "Y-m-d H:i:s" ) ,
				'modifiedAt' => date( "Y-m-d H:i:s" )
			] );
			$addressId = App::get( 'database' )->lastInsertId();
			$role      = App::get( 'database' )->find( 'roles' , [
				'type' => 'customer'
			] );

			App::get( 'database' )->insert( 'users' , [
				'firstName'  => $_POST[ 'firstName' ] ,
				'lastName'   => $_POST[ 'lastName' ] ,
				'addressId'  => $addressId ,
				'email'      => $_POST[ 'email' ] ,
				'password'   => $password ,
				'roleId'     => $role->id ,
				'createdAt'  => date( "Y-m-d H:i:s" ) ,
				'modifiedAt' => date( "Y-m-d H:i:s" )
			] );
		}
	}