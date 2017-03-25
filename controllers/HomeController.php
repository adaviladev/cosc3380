<?php

	namespace App\Controllers;

	use Address;
	use App\Core\App;
	use App\Core\Auth;
	use Package;
	use PackageStatus;
	use State;
	use User;

	class HomeController {
		public function home() {
			$user = Auth::user();
			if( $user && $user->roleId == 2 ) {
				$packages = Package::findAll()
				                   ->where( [ 'postOfficeId' ] , [ '=' ] , [ $user->postOfficeId ] )
				                   ->limit( 6 )
				                   ->orderBy( 'createdAt' , 'DESC' )
				                   ->get();
				foreach( $packages as $package ) {
					$package->destination   = Address::find()
					                                 ->where( [ 'id' ] , [ '=' ] , [ $package->destinationId ] )
					                                 ->get();
					$package->destination->state   = State::find()
					                                 ->where( [ 'id' ] , [ '=' ] , [ $package->destination->stateId ] )
					                                 ->get();
					$package->returnAddress = Address::find()
					                                 ->where( [ 'id' ] , [ '=' ] , [ $package->returnAddressId ] )
					                                 ->get();
					$package->returnAddress->state   = State::find()
					                                        ->where( [ 'id' ] , [ '=' ] , [ $package->returnAddress->stateId ] )
					                                        ->get();
					$package->status   = PackageStatus::find()
					                                        ->where( [ 'id' ] , [ '=' ] , [ $package->packageStatus ] )
					                                        ->get();

					$package->user          = User::find()
					                              ->where( [ 'id' ] , [ '=' ] , [ $package->userId ] );
				}

				$employees = User::findAll()
				                 ->where( [ 'postOfficeId' , 'roleId' ] , [ '=' , '=' ] ,
				                          [ $user->postOfficeId , $user->roleId ] )
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

				return view( 'dashboard/dashboard' , compact( 'user' , 'packages' , 'employees' , 'customers' ) );
			} else {
				redirect( 'login' );
			}
		}

		public function showEmployees() {
			$user = Auth::user();
			if( $user->roleId == 2 ) {
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
			} else {
				redirect( 'login' );
			}
		}

		public function employeeDetail( $employeeId ) {
			$employee = User::find()
			                ->where( [ 'id' ] , [ '=' ] , $employeeId )
			                ->get();

			dd( $employee );
		}

		public function editEmployeeDetail( $employeeId ) {
			$employee = User::find()
			                ->where( [ 'id' ] , [ '=' ] , $employeeId )
			                ->get();

			dd( $employee );
		}

	}