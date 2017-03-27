<?php

	namespace App\Controllers;

	use Address;
	use App\Core\App;
	use App\Core\Auth;
	use PostOffice;
	use Role;
	use State;
	use User;

	class UsersController {
		public function show() {
			$users = User::selectAll();

			return view( 'index' , compact( 'users' ) );
		}

		public function postOfficeUsers() {
			$user = Auth::user();
			$user->postOfficeId;

			$customers = User::findall()
			                 ->where( [ 'postOfficeId' ] , [ '=' ] , [ $user->postOfficeId ] )
			                 ->get();
			echo 'viktor was here';

			//dd( $customers );

			return view( 'dashboard/customers' , compact( 'customers' ) );
		}

		public function userDetail( $userId ) {
			$user = User::find()
			            ->where( [ 'id' ] , [ '=' ] , [ $userId ] )
			            ->get();

			return view( 'dashboard/userDetail' , compact( 'user' ) );
		}

		public function addEmployee() {
			$states = State::selectAll();

			return view( 'dashboard/addEmployee' , compact( 'states' ) );
		}

		public function storeEmployee() {
			$user     = Auth::user();
			$password = md5( $_POST[ 'password' ] );

			$duplicateAddress = null;

			if( isset( $_POST[ 'address' ] ) && $_POST[ 'address' ] !== '' ) {
				$duplicateAddress = Address::find()
				                           ->where( [
					                                    'street' ,
					                                    'city' ,
					                                    'stateId' ,
					                                    'zipCode' ,
				                                    ] , [
					                                    '=' ,
					                                    '=' ,
					                                    '=' ,
					                                    '='
				                                    ] , [
					                                    $_POST[ 'address' ] ,
					                                    $_POST[ 'city' ] ,
					                                    $_POST[ 'stateId' ] ,
					                                    $_POST[ 'zipCode' ]
				                                    ] )
				                           ->get();
				$addressId        = $duplicateAddress->id;
				if( ! $duplicateAddress ) {
					Address::insert( [
						                 'street'     => $_POST[ 'address' ] ,
						                 'city'       => $_POST[ 'city' ] ,
						                 'stateId'    => $_POST[ 'stateId' ] ,
						                 'zipCode'    => $_POST[ 'zipCode' ] ,
						                 'createdAt'  => date( "Y-m-d H:i:s" ) ,
						                 'modifiedAt' => date( "Y-m-d H:i:s" )
					                 ] );
					$addressId = Address::lastInsertId();
				}
				$addressId = $duplicateAddress;
			} else {
				$addressId = $duplicateAddress;
			}
			$role = Role::find()
			            ->where( [
				                     'type'
			                     ] , [ '=' ] , [ 'employee' ] )
			            ->get();

			$userInsert = User::insert( [
				                            'firstName'    => $_POST[ 'firstName' ] ,
				                            'lastName'     => $_POST[ 'lastName' ] ,
				                            'addressId'    => $addressId ,
				                            'email'        => $_POST[ 'email' ] ,
				                            'password'     => $password ,
				                            'roleId'       => $role->id ,
				                            'postOfficeId' => $user->postOfficeId ,
				                            'createdBy'    => $user->id ,
				                            'createdAt'    => date( "Y-m-d H:i:s" ) ,
				                            'modifiedAt'   => date( "Y-m-d H:i:s" )
			                            ] );

			if( $userInsert ) {
				$user = User::find()
				            ->where( [ 'id' ] , [ '=' ] , [ User::lastInsertId() ] )
				            ->get();

				redirect( 'dashboard/employees' );
				// return view( 'auth/register' );
			} else {
				switch( $userInsert ) {
					case '23000':
						$errors = array(
							'email' => 'Email already exists.'
						);

						return view( 'dashboard/employees/add' , compact( 'errors' ) );
				}
			}
		}

		public function accountInfo() {
			$user = Auth::user();

			return view( 'accounts/accountInfo' , compact( 'user' ) );
		}

		public function account() {
			return view( 'accounts/account' , compact( 'user' ) );
		}

		public function store() {
			$password = md5( $_POST[ 'password' ] );

			$duplicateAddress = null;

			if( isset( $_POST[ 'address' ] ) && $_POST[ 'address' ] !== '' ) {
				$duplicateAddress = Address::find()
				                           ->where( [
					                                    'street' ,
					                                    'city' ,
					                                    'stateId' ,
					                                    'zipCode' ,
				                                    ] , [
					                                    '=' ,
					                                    '=' ,
					                                    '=' ,
					                                    '='
				                                    ] , [
					                                    $_POST[ 'address' ] ,
					                                    $_POST[ 'city' ] ,
					                                    $_POST[ 'stateId' ] ,
					                                    $_POST[ 'zipCode' ]
				                                    ] )
				                           ->get();
				$addressId        = $duplicateAddress->id;
				if( ! $duplicateAddress ) {
					Address::insert( [
						                 'street'     => $_POST[ 'address' ] ,
						                 'city'       => $_POST[ 'city' ] ,
						                 'stateId'    => $_POST[ 'stateId' ] ,
						                 'zipCode'    => $_POST[ 'zipCode' ] ,
						                 'createdAt'  => date( "Y-m-d H:i:s" ) ,
						                 'modifiedAt' => date( "Y-m-d H:i:s" )
					                 ] );
					$addressId = Address::lastInsertId();
				}
				$addressId = $duplicateAddress;
			} else {
				$addressId = $duplicateAddress;
			}
			$role = Role::find()
			            ->where( [
				                     'type'
			                     ] , [ '=' ] , [ 'customer' ] )
			            ->get();

			$userInsert = User::insert( [
				                            'firstName'  => $_POST[ 'firstName' ] ,
				                            'lastName'   => $_POST[ 'lastName' ] ,
				                            'addressId'  => $addressId ,
				                            'email'      => $_POST[ 'email' ] ,
				                            'password'   => $password ,
				                            'roleId'     => $role->id ,
				                            'createdAt'  => date( "Y-m-d H:i:s" ) ,
				                            'modifiedAt' => date( "Y-m-d H:i:s" )
			                            ] );

			if( $userInsert == true ) {
				$user = User::find()
				            ->where( [ 'id' ] , [ '=' ] , [ $userInsert ] )
				            ->get();

				$_SESSION[ 'user' ] = serialize( $user );

				return redirect( 'account' );
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

		public function editEmployeeDetail( $employeeId ) {
			$user = Auth::user();
			if( $user->roleId == 2 ) {
				$employee           = User::find()
				                          ->where( [ 'id' ] , [ '=' ] , [ $employeeId ] )
				                          ->get();
				$employee->role     = Role::find()
				                          ->where( [ 'id' ] , [ '=' ] , [ $employee->roleId ] )
				                          ->get();
				$employee->address  = Address::find()
				                             ->where( [ 'id' ] , [ '=' ] , [ $employee->addressId ] )
				                             ->get();
				$employee->location = PostOffice::find()
				                                ->where( [ 'id' ] , [ '=' ] , [ $employee->postOfficeId ] )
				                                ->get();
				$states             = State::selectAll();

				return view( 'dashboard/editEmployee' , compact( 'employee' , 'states' ) );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			} else if( $user->roleId == 3 ) {
				return redirect( 'admin' );
			}

			return redirect( 'login' );
		}

		public function updateEmployeeDetail( $employeeId ) {
			$user = Auth::user();
			if( $user->roleId == 2 ) {
				$employee           = User::find()
				                          ->where( [ 'id' ] , [ '=' ] , [ $employeeId ] )
				                          ->get();
				$employee->role     = Role::find()
				                          ->where( [ 'id' ] , [ '=' ] , [ $employee->roleId ] )
				                          ->get();
				$employee->address  = Address::find()
				                             ->where( [ 'id' ] , [ '=' ] , [ $employee->addressId ] )
				                             ->get();
				$employee->location = PostOffice::find()
				                                ->where( [ 'id' ] , [ '=' ] , [ $employee->postOfficeId ] )
				                                ->get();
				$states             = State::selectAll();
				$bindings           = [];

				if( isset( $_POST[ 'addressStreet' ] ) ) {
					$bindings[ 'street' ] = $_POST[ 'addressStreet' ];
				}
				if( isset( $_POST[ 'addressCity' ] ) ) {
					$bindings[ 'city' ] = $_POST[ 'addressCity' ];
				}
				if( isset( $_POST[ 'addressStateId' ] ) ) {
					$bindings[ 'stateId' ] = $_POST[ 'addressStateId' ];
				}
				if( isset( $_POST[ 'zipCode' ] ) ) {
					$bindings[ 'street' ] = $_POST[ 'addressZipCode' ];
				}
				if( isset( $_POST[ 'deleteEmployee' ] ) ) {
					User::update( [
						              'active' => 0
					              ] )
					    ->where( [ 'id' ] , [ '=' ] , [ $employeeId ] )
					    ->get();
				} else if( isset( $_POST[ 'addEmployee' ] ) ) {
					User::update( [
						              'active' => 1
					              ] )
					    ->where( [ 'id' ] , [ '=' ] , [ $employeeId ] )
					    ->get();
				}

				if( !empty( $bindings ) ) {
					Address::update( $bindings )
					       ->where( [ 'id' ] , [ '=' ] , [ $employee->addressId ] )
					       ->get();
				}

				// dd( $bindings );

				return redirect( "dashboard/employees/{$employeeId}" );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			} else if( $user->roleId == 3 ) {
				return redirect( 'admin' );
			}

			return redirect( 'login' );
		}
	}