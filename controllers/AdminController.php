<?php

    namespace App\Controllers;

    use Package;
    use Transaction;
    use PostOffice;

    class AdminController {
        public function packages() {
            $packages = Package::selectAll();

            return view( 'admin/adminPackages' , compact( 'packages' ) );
        }

        public function transactions() {
            $transactions = Transaction::selectAll();

            return view( 'admin/adminTransactions' , compact( 'transactions' ) );
        }

        public function postOffices() {
            $postOffices = PostOffice::selectAll();

            return view( 'admin/adminPostOffices' , compact( 'postOffices' ) );
        }

        public function admin() {
            $packages = Package::selectAll();

            return view( 'admin/admin' , compact( 'packages' ) );
        }
}