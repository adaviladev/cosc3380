<?php

	namespace App\Controllers;

	use Address;
	use Package;
	use PackageStatus;
	use State;
	use User;
	use App\Core\App;
	use App\Core\Auth;
	use Transaction;

	class TransactionController {

		public function show() {
			$transactions = Transaction::selectAll();

			return view( 'index' , compact( 'transactions' ) );
		}

		/**
		 * postOfficeTransactions() gets all the transactions processed and assigned
		 * to the logged in user's post office
		 */
		public function postOfficeTransactions() {
			$user = Auth::user();
			$user->postOfficeId;
			$transactions = Transaction::findAll()
			                           ->where( [ 'postOfficeId' ] , [ '=' ] , [ $user->postOfficeId ] )
			                           ->get();

			foreach( $transactions as $transaction ) {
				$transaction->customer = User::find()->where(['id'],['='],[$transaction->customerId])->get();
			}


			return view( 'dashboard/transactions' , compact( 'transactions' ) );
		}

		/**
		 * transactionDetail() displays more info of one transaction processed by the
		 * logged in user's post office
		 */
		public function transactionDetail( $transactionId ) {
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId === 2 ) {
					$transaction                                = Transaction::find()
					                                                         ->where( [ 'id' ] , [ '=' ] ,
					                                                                  [ $transactionId ] )
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
				} else if( $user->roleId == 1 ) {
					return redirect( 'admin' );
				} else if( $user->roleId == 2 ) {
					return redirect( 'dashboard' );
				}
			}

			return redirect( 'login' );
		}

		public function userTransactions() {
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId == 3 ) {
					$transactions = Transaction::findAll()
					                           ->where( [ 'customerId' ] , [ '=' ] , [ $user->id ] )
					                           ->get();

					foreach( $transactions as $transaction ) {
						$transaction->customer        = User::find()
						                                    ->where( [ 'id' ] , [ '=' ] , [ $transaction->customerId ] )
						                                    ->get();
						$transaction->employee        = User::find()
						                                    ->where( [ 'id' ] , [ '=' ] , [ $transaction->employeeId ] )
						                                    ->get();
						$transaction->package         = Package::find()
						                                       ->where( [ 'id' ] , [ '=' ] ,
						                                                [ $transaction->packageId ] )
						                                       ->get();
						$transaction->package->status = PackageStatus::find()
						                                             ->where( [ 'id' ] , [ '=' ] ,
						                                                      [ $transaction->package->packageStatus ] )
						                                             ->get()->type;
					}

					return view( 'accounts/transactions' , compact( 'transactions' ) );
				} else if( $user->roleId == 1 ) {
					return redirect( 'admin' );
				} else if( $user->roleId == 2 ) {
					return redirect( 'dashboard' );
				}
			}

			return redirect( 'login' );
		}

		public function userTransactionDetail( $transactionId ) {
			$user = Auth::user();
			if( $user ) {
				if( $user->roleId == 3 ) {
					$transaction                                = Transaction::find()
					                                                         ->where( [ 'id' ] , [ '=' ] ,
					                                                                  [ $transactionId ] )
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

					return view( 'accounts/transactionDetail' , compact( 'transaction' ) );
				} else if( $user->roleId == 1 ) {
					return redirect( 'admin' );
				} else if( $user->roleId == 2 ) {
					return redirect( 'dashboard' );
				}
			}

			return redirect( 'login' );
		}

	}



