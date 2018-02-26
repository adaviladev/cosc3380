<?php

	namespace App\Controllers;

	use App\Core\Auth;
	use Email;
	use Package;
	use Role;
	use Transaction;
	use PostOffice;
	use User;
	use Address;
	use State;
	use PackageStatus;

	class AdminController {

        /**
         * @return mixed returns all packages in the database
         */
        public function packages() {
			$user = Auth::user();
			if( $user && $user->roleId == 1 ) {
				$packages = Package::selectAll();

				foreach( $packages as $package ) {
					$package->user                 = User::find()
					                                     ->where( [ 'id' ] , [ '=' ] , [ $package->userId ] )
					                                     ->get();
					$package->destination          = Address::find()
					                                        ->where( [ 'id' ] , [ '=' ] , [ $package->destinationId ] )
					                                        ->get();
					$package->destination->state   = State::find()
					                                      ->where( [ 'id' ] , [ '=' ] ,
					                                               [ $package->destination->stateId ] )
					                                      ->get()->state;
					$package->returnAddress        = Address::find()
					                                        ->where( [ 'id' ] , [ '=' ] ,
					                                                 [ $package->returnAddressId ] )
					                                        ->get();
					$package->returnAddress->state = State::find()
					                                      ->where( [ 'id' ] , [ '=' ] ,
					                                               [ $package->returnAddress->stateId ] )
					                                      ->get()->state;
					$package->status               = PackageStatus::find()
					                                              ->where( [ 'id' ] , [ '=' ] ,
					                                                       [ $package->packageStatus ] )
					                                              ->get()->type;
				}

				return view( 'admin/adminPackages' , compact( 'packages' ) );
			} else if( $user->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

        /**
         * @param $postOfficeId
         * @return mixed returns all packages for a selected postOffice
         */
        public function postOfficePackages($postOfficeId ) {
			$user = Auth::user();
			if( $user && $user->roleId == 1 ) {
				$packages = Package::findAll()
				                   ->where( [ 'postOfficeId' ] , [ '=' ] , [ $postOfficeId ] )
				                   ->get();

				foreach( $packages as $package ) {
					$package->user                 = User::find()
					                                     ->where( [ 'id' ] , [ '=' ] , [ $package->userId ] )
					                                     ->get();
					$package->destination          = Address::find()
					                                        ->where( [ 'id' ] , [ '=' ] , [ $package->destinationId ] )
					                                        ->get();
					$package->destination->state   = State::find()
					                                      ->where( [ 'id' ] , [ '=' ] ,
					                                               [ $package->destination->stateId ] )
					                                      ->get();
					$package->returnAddress        = Address::find()
					                                        ->where( [ 'id' ] , [ '=' ] ,
					                                                 [ $package->returnAddressId ] )
					                                        ->get();
					$package->returnAddress->state = State::find()
					                                      ->where( [ 'id' ] , [ '=' ] ,
					                                               [ $package->returnAddress->stateId ] )
					                                      ->get();
					$package->status               = PackageStatus::find()
					                                              ->where( [ 'id' ] , [ '=' ] ,
					                                                       [ $package->packageStatus ] )
					                                              ->get();
				}

				return view( 'admin/adminPackages' , compact( 'packages' ) );
			} else if( $user->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

        /**
         * @return mixed returns all transactions in the database
         */
        public function transactions() {
			$user = Auth::user();
			if( $user && $user->roleId == 1 ) {
				$transactions = Transaction::selectAll();

				foreach( $transactions as $transaction ) {
					$transaction->postOffice = PostOffice::find()
					                                     ->where( [ 'id' ] , [ '=' ] , [ $transaction->postOfficeId ] )
					                                     ->get();
					$transaction->customer   = User::find()
					                               ->where( [ 'id' ] , [ '=' ] , [ $transaction->customerId ] )
					                               ->get();
					$transaction->employee   = User::find()
					                               ->where( [ 'id' ] , [ '=' ] , [ $transaction->employeeId ] )
					                               ->get();
					$transaction->package    = Package::find()
					                                  ->where( [ 'id' ] , [ '=' ] , [ $transaction->packageId ] )
					                                  ->get();
				}

				return view( 'admin/adminTransactions' , compact( 'transactions' ) );
			} else if( $user->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

        /**
         * @param $transactionId
         * @return mixed returns detailed information for the selected transaction
         */
        public function transactionDetail($transactionId ) {
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId === 1 ) {
					$transaction = Transaction::find()
					                          ->where( [ 'id' ] , [ '=' ] , [ $transactionId ] )
					                          ->get();

					$transaction->customer                      = User::find()
					                                                  ->where( [ 'id' ] , [ '=' ] ,
					                                                           [ $transaction->customerId ] )
					                                                  ->get();
					$transaction->employee                      = User::find()
					                                                  ->where( [ 'id' ] , [ '=' ] ,
					                                                           [ $transaction->employeeId ] )
					                                                  ->get();
					$transaction->package                       = Package::find()
					                                                     ->where( [ 'id' ] , [ '=' ] ,
					                                                              [ $transaction->packageId ] )
					                                                     ->get();
					$transaction->package->status               = PackageStatus::find()
					                                                           ->where( [ 'id' ] , [ '=' ] ,
					                                                                    [ $transaction->package->packageStatus ] )
					                                                           ->get()->type;
					$transaction->package->destination          = Address::find()
					                                                     ->where( [ 'id' ] , [ '=' ] ,
					                                                              [ $transaction->package->destinationId ] )
					                                                     ->get();
					$transaction->package->destination->state   = State::find()
					                                                   ->where( [ 'id' ] , [ '=' ] ,
					                                                            [ $transaction->package->destination->stateId ] )
					                                                   ->get()->state;
					$transaction->package->returnAddress        = Address::find()
					                                                     ->where( [ 'id' ] , [ '=' ] ,
					                                                              [ $transaction->package->returnAddressId ] )
					                                                     ->get();
					$transaction->package->returnAddress->state = State::find()
					                                                   ->where( [ 'id' ] , [ '=' ] ,
					                                                            [ $transaction->package->returnAddress->stateId ] )
					                                                   ->get()->state;

					return view( 'dashboard/transactionDetail' , compact( 'transaction' ) );
				} else if( $user->roleId == 3 ) {
					return redirect( 'account' );
				} else if( $user->roleId == 2 ) {
					return redirect( 'dashboard' );
				}
			}

			return redirect( 'login' );
		}

        /**
         * @param $postOfficeId
         * @return mixed returns all customers for a selected postOffice
         */
        public function customers($postOfficeId ) {
			$auth = Auth::user();
			if( $auth && $auth->roleId == 1 ) {
				$customerPackages = Package::findAll()
				                           ->where( [ 'postOfficeId' ] , [ '=' ] , [ $postOfficeId ] )
				                           ->get();
				$customers        = [];
				foreach( $customerPackages as $customerPackage ) {

					$customers[] = User::find()
					                   ->where( [ 'id' ] , [ '=' ] , [ $customerPackage->userId ] )
					                   ->get();
				}

				foreach( $customers as $customer ) {
					$customer->packageCount     = count( Package::findAll()
					                                            ->where( [ 'userId' ] , [ '=' ] , [ $customer->id ] )
					                                            ->get() );
					$customer->transactions     = Transaction::findAll()
					                                         ->where( [ 'customerId' ] , [ '=' ] , [ $customer->id ] )
					                                         ->get();
					$customer->transactionCount = count( $customer->transactions );
					$customer->transactionTotal = 0;
					foreach( $customer->transactions as $transaction ) {
						$customer->transactionTotal = $customer->transactionTotal + $transaction->cost;
					}
					if( $customer->transactionCount !== 0 ) {
						$customer->averageSpent = $customer->transactionTotal / $customer->transactionCount;
					} else {
						$customer->averageSpent = 0;
					}
				}

				return view( 'admin/adminUsers' , compact( 'customers' , 'postOfficeId' ) );
			} else if( $auth->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $auth->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

		public function customerDetail( $customerId ) {
			$customer = User::find()
			                ->where( [ 'id' ] , [ '=' ] , [ $customerId ] )
			                ->get();
			$user     = Auth::user();

			if( $user ) {
				if( $user->roleId == 1 ) {
					$packages = Package::findAll()
					                   ->where( [ 'userId' ] , [ '=' ] , [ $customerId ] )
					                   ->orderBy( 'createdAt' , 'desc' )
					                   ->get();
					foreach( $packages as $package ) {
						$package->destination          = Address::find()
						                                        ->where( [ 'id' ] , [ '=' ] ,
						                                                 [ $package->destinationId ] )
						                                        ->get();
						$package->destination->state   = State::find()
						                                      ->where( [ 'id' ] , [ '=' ] ,
						                                               [ $package->destination->stateId ] )
						                                      ->get();
						$package->returnAddress        = Address::find()
						                                        ->where( [ 'id' ] , [ '=' ] ,
						                                                 [ $package->returnAddressId ] )
						                                        ->get();
						$package->returnAddress->state = State::find()
						                                      ->where( [ 'id' ] , [ '=' ] ,
						                                               [ $package->returnAddress->stateId ] )
						                                      ->get();
						$package->status               = PackageStatus::find()
						                                              ->where( [ 'id' ] , [ '=' ] ,
						                                                       [ $package->packageStatus ] )
						                                              ->get();
					}

					return view( 'dashboard/userDetail' , compact( 'customer' , 'packages' ) );
				} else if( $user->roleId == 2 ) {
					return redirect( 'dashboard' );
				} else if( $user->roleId == 3 ) {
					return redirect( 'account' );
				}
			}
			return redirect( 'login' );
		}

        /**
         * @return mixed returns all users in the database. Only users with packages are displayed
         */
        public function users() {
			$auth = Auth::user();
			if( $auth && $auth->roleId == 1 ) {
				$customers = User::findAll()
				                 ->where( [ 'roleId' ] , [ '=' ] , [ 3 ] )
				                 ->get();

				foreach( $customers as $customer ) {
					$customer->packageCount     = count( Package::findAll()
					                                            ->where( [ 'userId' ] , [ '=' ] , [ $customer->id ] )
					                                            ->get() );
					$customer->transactions     = Transaction::findAll()
					                                         ->where( [ 'customerId' ] , [ '=' ] , [ $customer->id ] )
					                                         ->get();
					$customer->transactionCount = count( $customer->transactions );
					$customer->transactionTotal = 0;
					foreach( $customer->transactions as $transaction ) {
						$customer->transactionTotal = $customer->transactionTotal + $transaction->cost;
					}
					if( $customer->transactionCount !== 0 ) {
						$customer->averageSpent = $customer->transactionTotal / $customer->transactionCount;
					} else {
						$customer->averageSpent = 0;
					}
				}

				return view( 'admin/adminUsers' , compact( 'customers' ) );
			} else if( $auth->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $auth->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

        /**
         * @return mixed Returns all employees in the database
         */
        public function employees() {
			$auth = Auth::user();
			if( $auth && $auth->roleId == 1 ) {
				$employees = User::findAll()
				                 ->where( [ 'roleId' ] , [ '=' ] , [ '2' ] )
				                 ->get();

				foreach( $employees as $employee ) {
					$employee->addedBy = User::find()
					                         ->where( [ 'id' ] , [ '=' ] , [ $employee->createdBy ] )
					                         ->get();
				}

				return view( 'dashboard/employees' , compact( 'employees' ) );
			} else if( $auth->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $auth->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

        /**
         * @param $postOfficeId
         * @return mixed returns all employees for a selected postOffice
         */
        public function postOfficeEmployees($postOfficeId ) {
			$auth = Auth::user();
			if( $auth && $auth->roleId == 1 ) {
				$employees = User::findAll()
				                 ->where( [ 'roleId' , 'postOfficeId' ] , [ '=' , '=' ] , [ '2' , $postOfficeId ] )
				                 ->get();

				foreach( $employees as $employee ) {
					$employee->addedBy = User::find()
					                         ->where( [ 'id' ] , [ '=' ] , [ $employee->createdBy ] )
					                         ->get();
				}

				return view( 'dashboard/employees' , compact( 'employees' ) );
			} else if( $auth->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $auth->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

        /**
         * @return mixed returns all postOffices
         */
        public function postOffices() {
			$user = Auth::user();
			if( $user && $user->roleId == 1 ) {
				$postOffices = PostOffice::selectAll();

				foreach( $postOffices as $postOffice ) {
					$postOffice->state        = State::find()
					                                 ->where( [ 'id' ] , [ '=' ] , [ $postOffice->stateId ] )
					                                 ->get()->state;
					$postOffice->packageCount = count( Package::findAll()
					                                          ->where( [ 'postOfficeId' ] , [ '=' ] ,
					                                                   [ $postOffice->id ] )
					                                          ->get() );
				}

				return view( 'admin/adminPostOffices' , compact( 'postOffices' ) );
			} else if( $user->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

        /**
         * @param $postOfficeId
         * @return mixed returns detailed information for the selected postOffice
         */
        public function selectedPostOffice($postOfficeId ) {
			$user = Auth::user();
			if( $user && $user->roleId == 1 ) {
				$packages = Package::findAll()
				                   ->where( [ 'postOfficeId' , 'packageStatus' ] , [ '=' , '<>' ] ,
				                            [ $postOfficeId , '4' ] )
				                   ->limit( 6 )
				                   ->orderBy( 'createdAt' , 'DESC' )
				                   ->get();
				foreach( $packages as $package ) {
					$package->destination          = Address::find()
					                                        ->where( [ 'id' ] , [ '=' ] , [ $package->destinationId ] )
					                                        ->get();
					$package->destination->state   = State::find()
					                                      ->where( [ 'id' ] , [ '=' ] ,
					                                               [ $package->destination->stateId ] )
					                                      ->get();
					$package->returnAddress        = Address::find()
					                                        ->where( [ 'id' ] , [ '=' ] ,
					                                                 [ $package->returnAddressId ] )
					                                        ->get();
					$package->returnAddress->state = State::find()
					                                      ->where( [ 'id' ] , [ '=' ] ,
					                                               [ $package->returnAddress->stateId ] )
					                                      ->get();
					$package->status               = PackageStatus::find()
					                                              ->where( [ 'id' ] , [ '=' ] ,
					                                                       [ $package->packageStatus ] )
					                                              ->get();
					$package->user                 = User::find()
					                                     ->where( [ 'id' ] , [ '=' ] , [ $package->userId ] );
				}

				$employees = User::findAll()
				                 ->where( [ 'postOfficeId' , 'roleId' , 'active' ] , [ '=' , '=' , '=' ] ,
				                          [ $postOfficeId , 2 , 1 ] )
				                 ->get();
				foreach( $employees as $employee ) {
					$employee->addedBy = User::find( [ 'firstName' , 'lastName' ] )
					                         ->where( [
						                                  'id'
					                                  ] , [ '=' ] , [ $employee->createdBy ] )
					                         ->limit( 6 )
					                         ->get();
				}

				$customerPackages = Package::findAll()
				                           ->where( [ 'postOfficeId' ] , [ '=' ] , [ $postOfficeId ] )
				                           ->get();
				$customerIds      = [];
				foreach( $customerPackages as $customerPackage ) {
					$customerIds[] = $customerPackage->userId;
				}
				$customers = User::findAll()
				                 ->whereIn( $customerIds )
				                 ->limit( 6 )
				                 ->get();
				foreach( $customers as $customer ) {
					$customer->packageCount = count( Package::findAll()
					                                        ->where( [ 'userId' ] , [ '=' ] , [ $customer->id ] )
					                                        ->get() );
				}

				return view( 'admin/adminPostOfficeDetail' ,
				             compact( 'user' , 'packages' , 'employees' , 'customers' , 'postOfficeId' ) );
			} else {
				return redirect( 'login' );
			}
		}

        /**
         * @return mixed returns information for the admin home page
         */
        public function admin() {
			$user = Auth::user();
			if( $user && $user->roleId == 1 ) {
				$packages = Package::findAll()
				                   ->where( [ 'packageStatus' ] , [ '<>' ] , [ '4' ] )
				                   ->limit( 6 )
				                   ->orderBy( 'createdAt' , 'DESC' )
				                   ->get();
				foreach( $packages as $package ) {
					$package->destination          = Address::find()
					                                        ->where( [ 'id' ] , [ '=' ] , [ $package->destinationId ] )
					                                        ->get();
					$package->destination->state   = State::find()
					                                      ->where( [ 'id' ] , [ '=' ] ,
					                                               [ $package->destination->stateId ] )
					                                      ->get()->state;
					$package->returnAddress        = Address::find()
					                                        ->where( [ 'id' ] , [ '=' ] ,
					                                                 [ $package->returnAddressId ] )
					                                        ->get();
					$package->returnAddress->state = State::find()
					                                      ->where( [ 'id' ] , [ '=' ] ,
					                                               [ $package->returnAddress->stateId ] )
					                                      ->get()->state;
					$package->status               = PackageStatus::find()
					                                              ->where( [ 'id' ] , [ '=' ] ,
					                                                       [ $package->packageStatus ] )
					                                              ->get()->type;

					$package->user = User::find()
					                     ->where( [ 'id' ] , [ '=' ] , [ $package->userId ] );
				}

				$admins = User::findAll()
				              ->where( [ 'roleId' , 'active' ] , [ '=' , '=' ] , [ $user->roleId , 1 ] )
				              ->limit( 6 )
				              ->orderBy( 'createdAt' , 'DESC' )
				              ->get();
				foreach( $admins as $admin ) {
					$admin->addedBy = User::find( [ 'firstName' , 'lastName' ] )
					                      ->where( [
						                               'id'
					                               ] , [ '=' ] , [ $admin->createdBy ] )
					                      ->limit( 6 )
					                      ->get();
				}

				$postOffices = PostOffice::selectAll();
				foreach( $postOffices as $postOffice ) {
					$postOffice->packages = Package::findAll()
					                               ->where( [ 'postOfficeId' ] , [ '=' ] , [ $postOffice->id ] )
					                               ->get();
					$postOffice->state    = State::find()
					                             ->where( [ 'id' ] , [ '=' ] , [ $postOffice->stateId ] )
					                             ->get()->state;
				}

				return view( 'admin/admin' , compact( 'user' , 'packages' , 'admins' , 'postOffices' ) );
			} else {
				return redirect( 'login' );
			}
		}

        /**
         * @return mixed allows an admin to store an employee in the database
         */
        public function storeEmployee() {
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId === 1 ) {
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
						// $addressId = $duplicateAddress->id;
						if( empty( $duplicateAddress ) ) {
							$addressId = Address::insert( [
								                              'street'     => $_POST[ 'address' ] ,
								                              'city'       => $_POST[ 'city' ] ,
								                              'stateId'    => $_POST[ 'stateId' ] ,
								                              'zipCode'    => $_POST[ 'zipCode' ] ,
								                              'createdAt'  => date( "Y-m-d H:i:s" ) ,
								                              'modifiedAt' => date( "Y-m-d H:i:s" )
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
						                            'createdAt'    => date( "Y-m-d H:i:s" ) ,
						                            'modifiedAt'   => date( "Y-m-d H:i:s" )
					                            ] );

					// dd( $userInsert );
					if( ! is_string( $userInsert ) ) {
						// $user = User::find()
						//             ->where( [ 'id' ] , [ '=' ] , [ $userInsert ] )
						//             ->get();

						return redirect( 'admin/employees' );
						// return view( 'auth/register' );
					} else {
						$states = State::selectAll();
						switch( $userInsert ) {
							case '23000':
								$errors = array(
									'email' => 'Email already exists.'
								);

								// dd( $userInsert );
								return view( 'dashboard/addEmployee' , compact( 'errors' , 'states' ) );
						}
					}
				} else {
					return redirect( 'account' );
				}
			}

			return redirect( 'login' );
		}

        /**
         * @return mixed returns emails
         */
        public function emails(){
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId === 1 ) {
					$emails = Email::selectAll();
					foreach( $emails as $email ) {
						$email->user = User::find()->where(['id'],['='],[$email->userId])->get();
						$email->package = Package::find()->where(['id'],['='],[$email->packageId])->get();
					}

					// dd( $outboxEmails );
					return view( 'admin/emails' , compact( 'emails' ) );
				} else if( $user->roleId === 2 ) {
					return redirect( 'dashboard' );
				} else if( $user->roleId === 3 ) {
					return redirect( 'account' );
				}
			}

			return redirect( 'login' );
		}
	}