<?php

	namespace App\Controllers;

	use Address;
	use App\Core\App;
	use App\Core\Auth;
	use Package;
	use User;

	class HomeController {
		public function home() {
			$user = Auth::user();
			if( $user ) {
				$packages = Package::findAll()
				                   ->where( [ 'postOfficeId' ] ,
				                            [ '=' ] ,
				                            [ $user->postOfficeId ] )
				                   ->limit( 6 )
				                   ->orderBy( 'createdAt' ,
				                              'DESC' )
				                   ->get();
				foreach( $packages as $package ) {
					$package->destination   = Address::find()
					                                 ->where( [ 'id' ] ,
					                                          [ '=' ] ,
					                                          [ $package->destinationId ] )
					                                 ->get();
					$package->returnAddress = Address::find()
					                                 ->where( [ 'id' ] ,
					                                          [ '=' ] ,
					                                          [ $package->returnAddressId ] )
					                                 ->get();
				}

				$employees = User::findAll()
				                 ->where( [ 'postOfficeId' , 'roleId' ] ,
				                          [ '=' , '=' ] ,
				                          [ $user->postOfficeId , $user->roleId ] )
				                 ->get();
				foreach( $employees as $employee ) {
					$employee->addedBy = User::find( [ 'firstName' , 'lastName' ] )
					                         ->where( [
						                                  'id'
					                                  ] ,
					                                  [ '=' ] ,
					                                  [ $employee->createdBy ] )
					                         ->limit( 6 )
					                         ->get();
				}

				$customers = User::findAll()
				                 ->where( [ 'roleId' ] ,
				                          [ '>' ] ,
				                          [ $user->roleId ] )
				                 ->limit( 6 )
				                 ->get();

				select * from users where id in (select userId from packages where postOfficeId = $user->postOfficeId)

				// dd( $customers );
				return view( 'dashboard/dashboard' ,
				             compact( 'user' ,
				                      'packages' ,
				                      'employees' ,
				                      'customers' ) );
			} else {
				redirect( 'login' );
			}
		}

		public function showEmployees() {
			$user = Auth::user();
			if( $user->roleId == 2 ) {
				$employees = User::findAll()
				                 ->where( [ 'postOfficeId' , 'roleId' ] ,
				                          [ '=' , '=' ] ,
				                          [ $user->postOfficeId , $user->roleId ] )
				                 ->get();

				dd( $employees );
			} else {
				redirect( 'login' );
			}
		}

		public function employeeDetail( $employeeId ) {
			$employee = User::find()
			                ->where( [ 'id' ] ,
			                         [ '=' ] ,
			                         $employeeId )
			                ->get();

			dd( $employee );
		}

		public function editEmployeeDetail( $employeeId ) {
			$employee = User::find()
			                ->where( [ 'id' ] ,
			                         [ '=' ] ,
			                         $employeeId )
			                ->get();

			dd( $employee );
		}

	}