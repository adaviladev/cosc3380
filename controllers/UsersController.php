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

			$password = md5( $_POST[ 'password' ] );

			$duplicateAddress = App::get( 'database' )->find( 'addresses' , [
				'street'  => $_POST[ 'address' ] ,
				'city'    => $_POST[ 'city' ] ,
				'stateId' => $_POST[ 'stateId' ] ,
				'zipCode' => $_POST[ 'zipCode' ]
			] , 'Address' );
			if( ! $duplicateAddress ) {
				App::get( 'database' )->insert( 'addresses' , [
					'street'     => $_POST[ 'address' ] ,
					'city'       => $_POST[ 'city' ] ,
					'stateId'    => $_POST[ 'stateId' ] ,
					'zipCode'    => $_POST[ 'zipCode' ] ,
					'createdAt'  => date( "Y-m-d H:i:s" ) ,
					'modifiedAt' => date( "Y-m-d H:i:s" )
				] );
				$addressId = App::get( 'database' )->lastInsertId();
			} else {
				$addressId = $duplicateAddress->id;
			}
			$role = App::get( 'database' )->find( 'roles' , [
				'type' => 'employee'
			] , 'Role' );

			$userInsert = App::get( 'database' )->insert( 'users' , [
				'firstName'  => $_POST[ 'firstName' ] ,
				'lastName'   => $_POST[ 'lastName' ] ,
				'addressId'  => $addressId ,
				'email'      => $_POST[ 'email' ] ,
				'password'   => $password ,
				'roleId'     => $role->id ,
				'createdAt'  => date( "Y-m-d H:i:s" ) ,
				'modifiedAt' => date( "Y-m-d H:i:s" )
			] );

			if( $userInsert === true ) {
				$user = App::get( 'database' )->find( 'users' , [
					'id' => App::get( 'database' )->lastInsertId()
				] , 'User' );

				$_SESSION[ 'user' ] = serialize( $user );
				var_dump( $_SESSION );

				// redirect( 'dashboard' );
				// return view( 'auth/register' );
			} else {
				switch( $userInsert ) {
					case '23000':
						$errors = array(
							'email' => 'Email already exists.'
						);

						return view( 'auth/register' , compact( 'errors' ) );
				}
			}
		}
	}