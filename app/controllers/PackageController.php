<?php

	namespace App\Controllers;

	use Address;
	use App\Core\App;
	use App\Core\Auth;
	use Package;
	use PackageStatus;
	use State;
	use User;

	class PackageController {

		public function postOfficeInventory() {
			$user = Auth::user();
			if( $user->roleId == 2 || $user->roleId == 1 ) {
				$packages = Package::findAll()->where( [ 'postOfficeId' ] ,
				                                       [ '=' ] ,
				                                       [ $user->postOfficeId ] )->get();

				foreach( $packages as $package ) {
					$package->user                 = User::find()->where( [ 'id' ] ,
					                                                      [ '=' ] ,
					                                                      [ $package->userId ] )->get();
					$package->destination          = Address::find()->where( [ 'id' ] ,
					                                                         [ '=' ] ,
					                                                         [ $package->destinationId ] )->get();
					$package->destination->state   = State::find()->where( [ 'id' ] ,
					                                                       [ '=' ] ,
					                                                       [ $package->destination->stateId ] )->get();
					$package->returnAddress        = Address::find()->where( [ 'id' ] ,
					                                                         [ '=' ] ,
					                                                         [ $package->returnAddressId ] )->get();
					$package->returnAddress->state = State::find()->where( [ 'id' ] ,
					                                                       [ '=' ] ,
					                                                       [ $package->returnAddress->stateId ] )->get();
					$package->status               = PackageStatus::find()->where( [ 'id' ] ,
					                                                               [ '=' ] ,
					                                                               [ $package->packageStatus ] )->get();
				}

				return view( 'dashboard/packages' ,
				             compact( 'packages' ) );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			} else if( $user->roleId == 1 ) {
				return redirect( 'admin' );
			}

			return redirect( 'login' );
		}

		public function editPackage( $packageId ) {
			$user = Auth::user();
			if( $user && $user->roleId == 2 || $user->roleId == 1 ) {
				$package                       = Package::find()->where( [ 'id' ] ,
				                                                         [ '=' ] ,
				                                                         [ $packageId ] )->get();
				$package->user                 = User::find()->where( [ 'id' ] ,
				                                                      [ '=' ] ,
				                                                      [ $package->userId ] )->get();
				$package->destination          = Address::find()->where( [ 'id' ] ,
				                                                         [ '=' ] ,
				                                                         [ $package->destinationId ] )->get();
				$package->destination->state   = State::find()->where( [ 'id' ] ,
				                                                       [ '=' ] ,
				                                                       [ $package->destination->stateId ] )->get()->state;
				$package->returnAddress        = Address::find()->where( [ 'id' ] ,
				                                                         [ '=' ] ,
				                                                         [ $package->returnAddressId ] )->get();
				$package->returnAddress->state = State::find()->where( [ 'id' ] ,
				                                                       [ '=' ] ,
				                                                       [ $package->returnAddress->stateId ] )->get()->state;
				$package->status               = PackageStatus::find()->where( [ 'id' ] ,
				                                                               [ '=' ] ,
				                                                               [ $package->packageStatus ] )->get();

				$states = State::selectAll();

				return view( 'dashboard/editPackage' ,
				             compact( 'package' ,
				                      'states' ) );
			} else if( $user->roleId == 1 ) {
				return redirect( 'admin' );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			}
		}

		public function updatePackage( $packageId ) {
			$user = Auth::user();
			if( $user && $user->roleId == 2 || $user->roleId == 1 ) {
				$package = Package::find()->where( [ 'id' ] ,
				                                   [ '=' ] ,
				                                   [ $packageId ] )->get();

				$address = Address::find()->where( [ 'id' ] ,
				                                   [ '=' ] ,
				                                   [ $package->destinationId ] )->get();
				Address::update( [
					                 'street'  => $_POST[ 'destinationAddressStreet' ] ,
					                 'city'    => $_POST[ 'destinationAddressCity' ] ,
					                 'stateId' => $_POST[ 'destinationAddressStateId' ] ,
					                 'zipCode' => $_POST[ 'destinationAddressZipCode' ]
				                 ] )->where( [ 'id' ] ,
				                             [ '=' ] ,
				                             [ $package->destinationId ] )->get();

				$address = Address::find()->where( [ 'id' ] ,
				                                   [ '=' ] ,
				                                   [ $package->destinationId ] )->get();

				return redirect( "dashboard/packages/{$packageId}" );
			} else if( $user->roleId == 1 ) {
				return redirect( 'admin' );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

		public function packageDetail( $packageId ) {
			$user = Auth::user();
			if( $user && ( $user->roleId == 2 || $user->roleId == 1 ) ) {
				$package = Package::find()->where( [ 'id' ] ,
				                                   [ '=' ] ,
				                                   [ $packageId ] )->get();
				if( $user->postOfficeId !== $package->postOfficeId && $user->roleId == 2 ) {
					return redirect( 'dashboard/packages' );
				}
				$package->status = PackageStatus::find()->where( [ 'id' ] ,
				                                                 [ '=' ] ,
				                                                 [ $package->packageStatus ] )->get();

				$package->user                 = User::find()->where( [ 'id' ] ,
				                                                      [ '=' ] ,
				                                                      [ $package->userId ] )->get();
				$package->destination          = Address::find()->where( [ 'id' ] ,
				                                                         [ '=' ] ,
				                                                         [ $package->destinationId ] )->get();
				$package->destination->state   = State::find()->where( [ 'id' ] ,
				                                                       [ '=' ] ,
				                                                       [ $package->destination->stateId ] )->get()->state;
				$package->returnAddress        = Address::find()->where( [ 'id' ] ,
				                                                         [ '=' ] ,
				                                                         [ $package->returnAddressId ] )->get();
				$package->returnAddress->state = State::find()->where( [ 'id' ] ,
				                                                       [ '=' ] ,
				                                                       [ $package->returnAddress->stateId ] )->get()->state;

				return view( 'dashboard/packageDetail' ,
				             compact( 'package' ) );
			} else if( $user->roleId == 3 ) {
				return redirect( 'account' );
			}

			return redirect( 'login' );
		}

		/**
		 * accountPackages()
		 * returns list of all packages sent by the logged in user
		 * for account/packages page
		 */
		public function accountPackages() {
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId == 3 ) {
					$packages = Package::findAll()->where( [ 'userId' ] ,
					                                       [ '=' ] ,
					                                       [ $user->id ] )->get();

					foreach( $packages as $package ) {
						$package->user                 = User::find()->where( [ 'id' ] ,
						                                                      [ '=' ] ,
						                                                      [ $package->userId ] )->get();
						$package->destination          = Address::find()->where( [ 'id' ] ,
						                                                         [ '=' ] ,
						                                                         [ $package->destinationId ] )->get();
						$package->destination->state   = State::find()->where( [ 'id' ] ,
						                                                       [ '=' ] ,
						                                                       [ $package->destination->stateId ] )->get()->state;
						$package->returnAddress        = Address::find()->where( [ 'id' ] ,
						                                                         [ '=' ] ,
						                                                         [ $package->returnAddressId ] )->get();
						$package->returnAddress->state = State::find()->where( [ 'id' ] ,
						                                                       [ '=' ] ,
						                                                       [ $package->returnAddress->stateId ] )->get()->state;
						$package->status               = PackageStatus::find()->where( [ 'id' ] ,
						                                                               [ '=' ] ,
						                                                               [ $package->packageStatus ] )->get();

						return view( 'accounts/accountPackages' ,
						             compact( 'packages' ) );
					}
				} else if( $user->roleId == 2 ) {
					return redirect( 'dashboard' );
				} else if( $user->roleId == 1 ) {
					return redirect( 'admin' );
				}
			}

			return redirect( 'login' );
		}

		/**
		 * accountPackageId
		 *
		 * @param $packageId == package info being requested
		 * this function is user specific and requires that the user is the one who sent
		 * the package or else it will redirect to account/packages or login appropriately
		 */
		public function accountPackagesId( $packageId ) {
			$user = Auth::user();

			$package = Package::find()->where( [ 'id' ] ,
			                                   [ '=' ] ,
			                                   [ $packageId ] )->get();
			if( $user ) {
				if( $user->roleId == 3 ) {
					if( $user->id == $package->userId ) {
						$package->status = PackageStatus::find()->where( [ 'id' ] ,
						                                                 [ '=' ] ,
						                                                 [ $package->packageStatus ] )->get();

						$package->user                 = User::find()->where( [ 'id' ] ,
						                                                      [ '=' ] ,
						                                                      [ $package->userId ] )->get();
						$package->destination          = Address::find()->where( [ 'id' ] ,
						                                                         [ '=' ] ,
						                                                         [ $package->destinationId ] )->get();
						$package->destination->state   = State::find()->where( [ 'id' ] ,
						                                                       [ '=' ] ,
						                                                       [ $package->destination->stateId ] )->get()->state;
						$package->returnAddress        = Address::find()->where( [ 'id' ] ,
						                                                         [ '=' ] ,
						                                                         [ $package->returnAddressId ] )->get();
						$package->returnAddress->state = State::find()->where( [ 'id' ] ,
						                                                       [ '=' ] ,
						                                                       [ $package->returnAddress->stateId ] )->get()->state;

						return view( 'accounts/accountPackagesId' ,
						             compact( 'package' ,
						                      'user' ) );
					} else {
						return redirect( 'account/packages' );
					}
				} else if( $user->roleId == 2 ) {
					return redirect( 'dashboard' );
				} else if( $user->roleId == 1 ) {
					return redirect( 'admin' );
				}
			} else {

				return redirect( 'login' );
			}
		}

		/**
		 * accountPackagesCancel($packageId)
		 *
		 * @param $packageId == id of packaged to be cancelled
		 * as this is an /account page, the user must be logged in to the package
		 * sender's account or be redirected
		 */
		public function accountPackagesCancel( $packageId ) {
			$user = Auth::user();

			$package = Package::find()->where( [ 'id' ] ,
			                                   [ '=' ] ,
			                                   [ $packageId ] )->get();
			if( $user->roleId == 3 ) {
				if( $user->id == $package->userId ) {
					$package->status               = PackageStatus::find()->where( [ 'id' ] ,
					                                                               [ '=' ] ,
					                                                               [ $package->packageStatus ] )->get();
					$package->user                 = User::find()->where( [ 'id' ] ,
					                                                      [ '=' ] ,
					                                                      [ $package->userId ] )->get();
					$package->destination          = Address::find()->where( [ 'id' ] ,
					                                                         [ '=' ] ,
					                                                         [ $package->destinationId ] )->get();
					$package->destination->state   = State::find()->where( [ 'id' ] ,
					                                                       [ '=' ] ,
					                                                       [ $package->destination->stateId ] )->get()->state;
					$package->returnAddress        = Address::find()->where( [ 'id' ] ,
					                                                         [ '=' ] ,
					                                                         [ $package->returnAddressId ] )->get();
					$package->returnAddress->state = State::find()->where( [ 'id' ] ,
					                                                       [ '=' ] ,
					                                                       [ $package->returnAddress->stateId ] )->get()->state;

					return view( 'accounts/accountPackagesCancel' ,
					             compact( 'package' ,
					                      'user' ) );
				} else {
					return redirect( 'account/packages/' );
				}
			} else if( $user->roleId == 2 ) {
				return redirect( 'dashboard' );
			} else if( $user->roleId == 1 ) {
				return redirect( 'admin' );
			}
			return redirect('login');
		}

		/**
		 *updatePackagesCancel()
		 * post method to update packageStatus variable of given package
		 * to 4; As with other /account pages the user who cancels using this method
		 * must be the package sender
		 */
		public function updatePackagesCancel() {
			$user = Auth::user();

			$package = Package::find()->where( [ 'id' ] ,
			                                   [ '=' ] ,
			                                   [ $_POST[ 'packageId' ] ] )->get();

			if( $user ) {
				if( $user->id == $package->userId ) {
					Package::update( [
						                 'packageStatus' => 4
					                 ] )->where( [ 'id' ] ,
					                             [ '=' ] ,
					                             [ $_POST[ 'packageId' ] ] )->get();
				} else {
					return redirect( 'account/packages' );
				}

				return redirect( 'account/packages' );
			} else {
				return redirect( 'login' );
			}
		}
	}