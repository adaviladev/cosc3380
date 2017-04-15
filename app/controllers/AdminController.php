<?php

	namespace App\Controllers;

	use App\Core\Auth;
	use Package;
	use Transaction;
	use PostOffice;
	use User;
	use Address;
	use State;
	use PackageStatus;

	class AdminController {
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

		public function transactionDetail( $transactionId ) {
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

		public function customers( $postOfficeId ) {
			$auth = Auth::user();
			if( $auth && $auth->roleId == 1 ) {
				$customers = User::findAll()
				                 ->where( [ 'roleId' , 'postOfficeId' ] , [ '=', '=' ] , [ 3, $postOfficeId ] )
				                 ->get();

				foreach( $customers as $customer ) {
					$customer->packageCount     = count( Package::findAll()
					                                            ->where( [ 'userId' ] , [ '=' ] ,
					                                                     [ $customer->id ] )
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

				return view( 'admin/adminUsers' , compact( 'customers' , 'postOfficeId') );
			} else if( $auth->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $auth->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

        public function customerDetail( $postOfficeId, $customerId ) {
            $customer = User::find()
                ->where( [ 'id' ] ,
                    [ '=' ] ,
                    [ $customerId ] )
                ->get();
            $user = Auth::user();

            if( $user && $user->roleId == 1) {
                $packages = Package::findAll()
                    ->where( [ 'userId' ] ,
                        [ '=' ] ,
                        [ $customerId ] )
                    ->orderBy( 'createdAt' ,
                        'desc' )
                    ->get();
                foreach( $packages as $package ) {
                    $package->destination          = Address::find()
                        ->where( [ 'id' ] ,
                            [ '=' ] ,
                            [ $package->destinationId ] )
                        ->get();
                    $package->destination->state   = State::find()
                        ->where( [ 'id' ] ,
                            [ '=' ] ,
                            [ $package->destination->stateId ] )
                        ->get();
                    $package->returnAddress        = Address::find()
                        ->where( [ 'id' ] ,
                            [ '=' ] ,
                            [ $package->returnAddressId ] )
                        ->get();
                    $package->returnAddress->state = State::find()
                        ->where( [ 'id' ] ,
                            [ '=' ] ,
                            [ $package->returnAddress->stateId ] )
                        ->get();
                    $package->status               = PackageStatus::find()
                        ->where( [ 'id' ] ,
                            [ '=' ] ,
                            [ $package->packageStatus ] )
                        ->get();
                }

                return view( 'dashboard/userDetail' ,
                    compact( 'customer' ,
                        'packages' ) );
            }  else if($user->roleId == 2 ) {
                return redirect( 'dashboard' );
            } else if($user->roleId == 3 ) {
                return redirect( 'account' );
            }
        }

		public function users() {
			$auth = Auth::user();
			if( $auth && $auth->roleId == 1 ) {
				$customers = User::findAll()
				                 ->where( [ 'roleId' ] , [ '=' ] , [ 3 ] )
				                 ->get();

                foreach( $customers as $customer ) {
                    $customer->packageCount     = count( Package::findAll()
                        ->where( [ 'userId' ] , [ '=' ] ,
                            [ $customer->id ] )
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

        public function employees() {
            $auth = Auth::user();
            if( $auth && $auth->roleId == 1 ) {
                $employees = User::findAll()
                    ->where( [ 'roleId' ] , [ '=' ] ,
                        [ '2'] )
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

		public function selectedPostOffice( $postOfficeId ) {
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
				             compact( 'user' , 'packages' , 'employees' , 'customers', 'postOfficeId' ) );
			} else {
				return redirect( 'login' );
			}
		}

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
	}