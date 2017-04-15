<?php

	namespace App\Controllers;

	use Address;
	use App\Core\App;
	use App\Core\Auth;
	use Package;
	use PackageStatus;
	use PostOffice;
	use Role;
	use State;
	use Transaction;
	use User;

	class HomeController {
		/**
		 * @return mixed returns dashboard view for the currently signed in Employee
		 */
		public function home() {
			$user = Auth::user();
			if( $user && $user->roleId == 2 || $user->roleId == 1 ) {
				$packages = Package::findAll()
				                   ->where( [ 'postOfficeId' , 'packageStatus' ] , [ '=' , '<>' ] ,
				                            [ $user->postOfficeId , '4' ] )
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

				$employees = User::findAll()
				                 ->where( [ 'postOfficeId' , 'roleId' , 'active' ] , [ '=' , '=' , '=' ] ,
				                          [ $user->postOfficeId , $user->roleId , 1 ] )
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
				                           ->where( [ 'postOfficeId' ] , [ '=' ] , [ $user->postOfficeId ] )
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

				$transactions = Transaction::findAll()
				                           ->limit( 6 )
				                           ->orderBy( 'createdAt' , 'DESC' )
				                           ->get();

				foreach( $transactions as $transaction ) {
					$transaction->customer = User::find()
					                             ->where( [ 'id' ] , [ '=' ] , [ $transaction->customerId ] )
					                             ->get();
				}

				return view( 'dashboard/dashboard' ,
				             compact( 'user' , 'packages' , 'employees' , 'customers' , 'transactions' ) );
			} else {
				return redirect( 'login' );
			}
		}

		/**
		 * @return mixed grab all employees from signed in user's post office
		 */
		public function showEmployees() {
			$user = Auth::user();
			if( $user->roleId == 2 || $user->roleId == 1 ) {
				$employees = User::findAll()
				                 ->where( [ 'postOfficeId' , 'roleId' ] , [ '=' , '=' ] ,
				                          [ $user->postOfficeId , $user->roleId ] )
				                 ->get();

				foreach( $employees as $employee ) {
					$employee->addedBy = User::find()
					                         ->where( [ 'id' ] , [ '=' ] , [ $employee->createdBy ] )
					                         ->get();
				}

				return view( 'dashboard/employees' , compact( 'employees' ) );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			} else if( $user->roleId == 1 ) {
				return redirect( 'admin' );
			}

			return redirect( 'login' );
		}
	}