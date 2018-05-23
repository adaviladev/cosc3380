<?php

	namespace App\Controllers;

	use Address;
	use App\Core\Auth;
	use Package;
	use PostOffice;
	use Role;
	use State;
	use Transaction;
	use User;

	class UsersController {
		public function show() {
			$users = User::selectAll();

			return view( 'index' ,
			             compact( 'users' ) );
		}

		/**
		 * postOfficeUsers() gets all the customers assigned to the currently logged in
		 * user's post office location
		 */
		public function postOfficeUsers() {
			$user = Auth::user();
			$user->postOfficeId;
			if( $user && $user->roleId === 2 ) {
				$packages = Package::findAll()->where( [ 'postOfficeId' ] ,
				                                       [ '=' ] ,
				                                       [ $user->postOfficeId ] )->get();
				$userIds = [];
				foreach( $packages as $package ) {
					$userIds[] = $package->userId;
				}
				$customers = User::findAll()->whereIn( $userIds )->get();

				return view( 'dashboard/customers' , compact( 'customers' ) );
			}

            if( $user && $user->roleId === 3 ) {
                return redirect( 'account' );
            }

            return redirect( 'login' );
		}

		/**
		 * @param int $customerId id of customer to update
		 * userDetail() gets the details of a single user assigned to the currently
		 * logged in user's post office
         *
         * @return mixed view
		 */
		public function userDetail( $customerId ) {

			$customer = User::find()->where( [ 'id' ] ,
			                                 [ '=' ] ,
			                                 [ $customerId ] )->get();

            /**
             * @var Package[] $packages
             */
			$packages = Package::findAll()->where( [ 'userId' ] ,
			                                       [ '=' ] ,
			                                       [ $customerId ] )->orderBy( 'createdAt' ,
			                                                                   'desc' )->get();
			foreach( $packages as $package ) {
				$package->hydrate();
			}

			return view( 'dashboard/userDetail' ,
			             compact( 'customer' ,
			                      'packages' ) );
		}

		/**
		 * @return mixed Display form for adding employees to own post office
		 */
		public function addEmployee() {
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId === 1 || $user->roleId === 2 ) {
					$states = State::selectAll();
					$roles  = Role::findAll()->where(['id'],['>='],[$user->roleId])->get();

					return view( 'dashboard/addEmployee' ,
					             compact( 'states' ,
					                      'roles' ) );
				}

                if( $user->roleId === 3 ){
                    return redirect('account' );
                }
            }
			return redirect( 'login' );
		}

		public function storeEmployee() {
			$user     = Auth::user();
			if( $user ){
				if( $user->roleId === 2 || $user->roleId === 1 ) {
					$password = md5( $_POST[ 'password' ] );

					$duplicateAddress = null;

					if( isset( $_POST[ 'address' ] ) && $_POST[ 'address' ] !== '' ) {
						$duplicateAddress = Address::find()
						                           ->where( [
							                                    'street' ,
							                                    'city' ,
							                                    'stateId' ,
							                                    'zipCode'
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
						// $addressId = $duplicateAddress->id;
						if( empty( $duplicateAddress ) ) {
							$addressId = Address::insert( [
								                              'street'     => $_POST[ 'address' ] ,
								                              'city'       => $_POST[ 'city' ] ,
								                              'stateId'    => $_POST[ 'stateId' ] ,
								                              'zipCode'    => $_POST[ 'zipCode' ] ,
								                              'createdAt'  => date('Y-m-d H:i:s') ,
								                              'modifiedAt' => date('Y-m-d H:i:s')
							                              ] );
							// dd( $addressId );
							// $addressId = Address::lastInsertId();
						} else {
							$addressId = $duplicateAddress->id;
						}
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
						                            'modifiedBy'   => $user->id ,
						                            'createdAt'    => date('Y-m-d H:i:s') ,
						                            'modifiedAt'   => date('Y-m-d H:i:s')
					                            ] );

					// dd( $userInsert );
					if(\is_string( $userInsert )) {
						$states = State::selectAll();
						switch( $userInsert ) {
							case '23000':
								$errors = array(
									'email' => 'Email already exists.'
								);

								// dd( $userInsert );
								return view( 'dashboard/addEmployee' , compact( 'errors' , 'states' ) );
						}
					} else {
						// $user = User::find()
						//             ->where( [ 'id' ] , [ '=' ] , [ $userInsert ] )
						//             ->get();

						return redirect( 'dashboard/employees' );
						// return view( 'auth/register' );
					}

				} else {
					return redirect( 'account' );
				}
			}
			return redirect( 'login' );
		}

		/**
		 * accountInfo()
		 * Gathers user's some of user's info to be sent to /account/info page
		 * upon request
		 * Info gathered: All info from User table and associated line on
		 * the address table
		 */
		public function accountInfo() {
			$user = Auth::user();
			if( ! $user ) {
				return view( 'auth/login' ,
				             compact( $user ) );
			}
			if( $user->roleId === 3 ) {
				$states    = State::selectAll();
				$address   = Address::find()->where( [ 'id' ] ,
				                                     [ '=' ] ,
				                                     [ $user->addressId ] )->get();
				$userState = State::find()->where( [ 'id' ] ,
				                                   [ '=' ] ,
				                                   [ $address->stateId ] )->get();
			} else if( $user->roleId === 2 ) {
				return redirect( 'dashboard' );
			} else if( $user->roleId === 1 ) {
				return redirect( 'admin' );
			}

			return view( 'accounts/accountInfo' ,
			             compact( 'user' ,
			                      'states' ,
			                      'address' ,
			                      'userState' ) );
		}

		/**
		 * passwordChange()
		 * confirms user is logged and compact()'s user's info to
		 * password change page
		 */
		public function passwordChange() {
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId === 3 ) {
					return view( 'accounts/accountPassword' ,
					             compact( 'user' ) );
				}

                if( $user->roleId === 2 ) {
                    return redirect( 'dashboard' );
                }

                if( $user->roleId === 1 ) {
                    return redirect( 'admin' );
                }
            }
			return view( 'auth/login' ,
				             compact( 'user' ) );
		}

		/**
		 * updatePassword()
		 * post route for accountPassword.view; sets flag based on given log in details
		 * $changeFlag === 3 correct login detail and password is updated
		 * $changeFlag === 1 or 2 given passwords didn't match or old password was wrong respectively
		 */
		public function updatePassword() {
			$user       = Auth::user();

			// TODO: This needs to get reworked due to duplicate conditional check
			if( $user ) {
				if( $user->password === md5( $_POST[ 'oldPassword' ] ) && $_POST[ 'newPassword' ] === $_POST[ 'confirmPassword' ] ) {
					$user->password = md5( $_POST[ 'newPassword' ] );
					User::update( [
						              'password' => md5( $_POST[ 'newPassword' ] )
					              ] )->where( [ 'id' ] ,
					                          [ '=' ] ,
					                          [ $user->id ] )->get();
					$changeFlag = 3;
				} else if( $user->password === md5( $_POST[ 'oldPassword' ] ) && $_POST[ 'newPassword' ] != $_POST[ 'confirmPassword' ] ) {
					$changeFlag = 1;
				} else {
					$changeFlag = 2;
				}

				return view( 'accounts/accountPassword' ,
				             compact( 'user' ,
				                      'changeFlag' ) );
			}

            return view( 'auth/login' ,
                         compact( 'user' ) );
        }

		/**
		 * updateAccountInfo()
		 * post method, changes user's old address info to new address info
		 * given in the account/info page
		 */
		public function updateAccountInfo() {
			$user = Auth::user();
			if( $user ) {
				Address::update( [
					                 'street'  => $_POST[ 'street' ] ,
					                 'city'    => $_POST[ 'city' ] ,
					                 'stateId' => $_POST[ 'stateId' ] ,
					                 'zipCode' => $_POST[ 'zipCode' ]
				                 ] )->where( [ 'id' ] ,
				                             [ '=' ] ,
				                             [ $user->addressId ] )->get();

				return redirect( 'account/info' );
			}

            return view( 'auth/login' ,
                         compact( 'user' ) );
        }

		public function account() {
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId === 3 ) {
                    /**
                     * @var Package[] $packages
                     */
					$packages = Package::findAll()->where( [ 'userId' ] ,
					                                       [ '=' ] ,
					                                       [ $user->id ] )->orderBy( 'createdAt' ,
					                                                                 'desc' )->limit( 6 )->get();

                    $states                        = State::selectAll();
					foreach( $packages as $package ) {
						$package->hydrate();
					}

					$transactions = Transaction::findAll()->where( [ 'customerId' ] ,
					                                               [ '=' ] ,
					                                               [ $user->id ] )->orderBy( 'createdAt' ,
					                                                                         'DESC' )->limit( 6 )->get();

					foreach( $transactions as $transaction ) {
						$transaction->package->hydrate();
					}

					// dd( $transactions );

					return view( 'accounts/account' ,
					             compact( 'user' ,
					                      'packages' ,
					                      'transactions' ) );
				}

                if( $user->roleId === 1 ) {
                    return view( 'admin/admin' ,
                                 compact( 'user' ) );
                }

                if( $user->roleId === 2 ) {
                    return view( 'dashboard/dashboard' ,
                                 compact( 'user' ) );
                }
            }

			return redirect( 'login' );
		}

		public function store() {
			$password = md5( $_POST[ 'password' ] );

			$addressId        = null;
			$duplicateAddress = null;

			if( isset( $_POST[ 'address' ] ) && $_POST[ 'address' ] !== '' ) {
				$duplicateAddress = Address::find()->where( [
					                                            'street' ,
					                                            'city' ,
					                                            'stateId' ,
					                                            'zipCode'
                ] ,
				                                            [
					                                            '=' ,
					                                            '=' ,
					                                            '=' ,
					                                            '='
				                                            ] ,
				                                            [
					                                            $_POST[ 'address' ] ,
					                                            $_POST[ 'city' ] ,
					                                            $_POST[ 'stateId' ] ,
					                                            $_POST[ 'zipCode' ]
				                                            ] )->get();
				// $addressId        = $duplicateAddress->id;
				if($duplicateAddress) {
					$addressId = $duplicateAddress->id;
				} else {
					$addressId = Address::insert( [
						                              'street'     => $_POST[ 'address' ] ,
						                              'city'       => $_POST[ 'city' ] ,
						                              'stateId'    => $_POST[ 'stateId' ] ,
						                              'zipCode'    => $_POST[ 'zipCode' ] ,
						                              'createdAt'  => date('Y-m-d H:i:s') ,
						                              'modifiedAt' => date('Y-m-d H:i:s')
					                              ] );
				}
			}
			$role = Role::find()->where( [
				                             'type'
			                             ] ,
			                             [ '=' ] ,
			                             [ 'customer' ] )->get();

			$userInsertId = User::insert( [
				                              'firstName'  => $_POST[ 'firstName' ] ,
				                              'lastName'   => $_POST[ 'lastName' ] ,
				                              'addressId'  => $addressId ,
				                              'email'      => $_POST[ 'email' ] ,
				                              'password'   => $password ,
				                              'roleId'     => $role->id ,
				                              'createdAt'  => date('Y-m-d H:i:s') ,
				                              'modifiedAt' => date('Y-m-d H:i:s')
			                              ] );

			if(\is_string( $userInsertId )) {
				$states = State::selectAll();
				switch( $userInsertId ) {
					case '23000':
						$errors = array(
							'email' => 'Email already exists.'
						);

						return view( 'auth/register' ,
						             compact( 'errors' ,
						                      'states' ) );
				}
			} else {
				$user = User::find()->where( [ 'id' ] ,
				                             [ '=' ] ,
				                             [ $userInsertId ] )->get();
				// dd( '.' ,
				//     $user ,
				//     "hit" );

				$_SESSION[ 'user' ] = serialize( $user );

				return redirect( 'account' );
				// return view( 'auth/register' );
			}
			return redirect( 'login' );
		}

		public function editEmployeeDetail( $employeeId ) {
			$user = Auth::user();
			if( $user && ( $user->roleId === 2 || $user->roleId === 1 ) ) {
				$employee           = User::find()->where( [ 'id' ] ,
				                                           [ '=' ] ,
				                                           [ $employeeId ] )->get();
				$employee->role     = Role::find()->where( [ 'id' ] ,
				                                           [ '=' ] ,
				                                           [ $employee->roleId ] )->get();
				$employee->address  = Address::find()->where( [ 'id' ] ,
				                                              [ '=' ] ,
				                                              [ $employee->addressId ] )->get();
				$employee->location = PostOffice::find()->where( [ 'id' ] ,
				                                                 [ '=' ] ,
				                                                 [ $employee->postOfficeId ] )->get();
				$states             = State::selectAll();
				
				return view( 'dashboard/editEmployee' ,
				             compact( 'employee' ,
				                      'states' ) );
			}

            if( $user->roleId === 3 ) {
                return redirect( 'account' );
            }

            if( $user && $user->roleId === 3 ) {
                return redirect( 'admin' );
            }

            return redirect( 'login' );
		}

		public function updateEmployeeDetail( $employeeId ) {
			$user = Auth::user();
			if( $user->roleId === 2 || $user->roleId === 1 ) {
				$employee           = User::find()->where( [ 'id' ] ,
				                                           [ '=' ] ,
				                                           [ $employeeId ] )->get();
				$employee->role     = Role::find()->where( [ 'id' ] ,
				                                           [ '=' ] ,
				                                           [ $employee->roleId ] )->get();
				$employee->address  = Address::find()->where( [ 'id' ] ,
				                                              [ '=' ] ,
				                                              [ $employee->addressId ] )->get();
				$employee->location = PostOffice::find()->where( [ 'id' ] ,
				                                                 [ '=' ] ,
				                                                 [ $employee->postOfficeId ] )->get();
				// $states             = State::selectAll();
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
					              ] )->where( [ 'id' ] ,
					                          [ '=' ] ,
					                          [ $employeeId ] )->get();
				} else if( isset( $_POST[ 'addEmployee' ] ) ) {
					User::update( [
						              'active' => 1
					              ] )->where( [ 'id' ] ,
					                          [ '=' ] ,
					                          [ $employeeId ] )->get();
				}

				if( ! empty( $bindings ) ) {
					Address::update( $bindings )->where( [ 'id' ] ,
					                                     [ '=' ] ,
					                                     [ $employee->addressId ] )->get();
				}

				// dd( $bindings );
				if( $user->roleId === 1 ) {
					return redirect( "admin/post-offices/{$employee->location->id}/employees" );
				} else {
					return redirect('dashboard/employees/');
				}
			} else if( $user->roleId === 3 ) {
				return redirect( 'account' );
            // TODO: Remove duplicate check
			} else if( $user->roleId === 1 ) {
				return redirect( 'admin' );
			}

			return redirect( 'login' );
		}
	}