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
            if ($user && $user->roleId == 1) {
                $packages = Package::selectAll();

                foreach( $packages as $package ) {
                    $package->user          = User::find()
                        ->where( [ 'id' ] ,
                            [ '=' ] ,
                            [ $package->userId ] )
                        ->get();
                    $package->destination   = Address::find()
                        ->where( [ 'id' ] ,
                            [ '=' ] ,
                            [ $package->destinationId ] )
                        ->get();
                    $package->destination->state = State::find()
                        ->where( ['id']  ,
                            [ '=' ] ,
                            [ $package->destination->stateId] )
                        ->get();
                    $package->returnAddress = Address::find()
                        ->where( [ 'id' ] ,
                            [ '=' ] ,
                            [ $package->returnAddressId ] )
                        ->get();
                    $package->returnAddress->state = State::find()
                        ->where( ['id']  ,
                            [ '=' ] ,
                            [ $package->returnAddress->stateId] )
                        ->get();
                    $package->status = PackageStatus::find()
                        ->where( ['id']  ,
                            [ '=' ] ,
                            [ $package->packageStatus] )
                        ->get();
                }
                return view( 'admin/adminPackages' , compact( 'packages' ) );
            } else if ($user->roleId == 2) {
                return redirect( 'dashboard' );
            } else if ($user->roleId == 3) {
                return redirect( 'account' );
            }
            return redirect('login');

        }

        public function transactions() {
            $user = Auth::user();
            if ($user && $user->roleId == 1) {
                $transactions = Transaction::selectAll();

                foreach ($transactions as $transaction) {
                    $transaction->postOffice = PostOffice::find()
                        ->where(['id'],
                            ['='],
                            [$transaction->postOfficeId])
                        ->get();
                    $transaction->customer = User::find()
                        ->where(['id'],
                            ['='],
                            [$transaction->customerId])
                        ->get();
                    $transaction->employee = User::find()
                        ->where(['id'],
                            ['='],
                            [$transaction->employeeId])
                        ->get();
                    $transaction->package = Package::find()
                        ->where(['id'],
                            ['='],
                            [$transaction->packageId])
                        ->get();
                }

                return view('admin/adminTransactions', compact('transactions'));
            }  else if ($user->roleId == 2) {
                return redirect( 'dashboard' );
            } else if ($user->roleId == 3) {
                return redirect( 'account' );
            }
            return redirect('login');
        }

        public function users() {
            $auth = Auth::user();
            if ($auth && $auth->roleId == 1) {
                $users = User::selectAll();

                foreach ($users as $user) {
                    $user->packageCount = count( Package::findAll()
                        ->where(['userId'],
                            ['='],
                            [$user->id])
                        ->get() );
                    $user->transactions = Transaction::findAll()
                        ->where(['id'],
                            ['='],
                            [$user->id])
                        ->get();
                    $user->transactionCount = count($user->transactions);
                    $user->transactionTotal = 0;
                    foreach ($user->transactions as $transaction) {
                        $user->transactionTotal = $user->transactionTotal + $transaction->cost;
                    }
                    $user->averageSpent = $user->transactionTotal / $user->transactionCount;


                }

                return view('admin/adminUsers', compact('users'));
            }  else if ($auth->roleId == 2) {
                return redirect( 'dashboard' );
            } else if ($auth->roleId == 3) {
                return redirect( 'account' );
            }
            return redirect('login');
        }

        public function postOffices()
        {
            $user = Auth::user();
            if ($user && $user->roleId == 1) {
                $postOffices = PostOffice::selectAll();

                foreach ($postOffices as $postOffice) {
                    $postOffice->state = State::find()
                        ->where(['id'], ['='], [$postOffice->stateId])
                        ->get()->state;
                }

                return view('admin/adminPostOffices', compact('postOffices'));
            }  else if ($user->roleId == 2) {
                return redirect( 'dashboard' );
            } else if ($user->roleId == 3) {
                return redirect( 'account' );
            }
            return redirect('login');
        }

        public function selectedPostOffice($postOfficeId) {
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
                    $package->user = User::find()
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

                return view( 'admin/adminPostOfficeDetail' , compact( 'user' , 'packages' , 'employees' , 'customers' ) );
            } else {
                redirect( 'login' );
            }
        }

        public function admin() {
            $user = Auth::user();
            if ($user && $user->roleId == 1) {
                $packages = Package::selectAll();

                return view('admin/admin', compact('packages'));
            }  else if ($user->roleId == 2) {
                return redirect( 'dashboard' );
            } else if ($user->roleId == 3) {
                return redirect( 'account' );
            }
            return redirect('login');
        }
}