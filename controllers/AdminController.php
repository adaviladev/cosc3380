<?php

    namespace App\Controllers;

    use Transaction;
    use PostOffice;
    use App\Core\App;
    use Role;
    use User;

    class AdminController {
        public function packages() {
            $packages = Package::selectAll();

            return view( 'index' , compact( 'packages' ) );
        }

        public function transactions() {
            $transactions = Transaction::selectAll();

            return view( 'index' , compact( 'transactions' ) );
        }

        public function postOffices() {
            $postOffices = PostOffice::selectAll();

            return view( 'index' , compact( 'postOffices' ) );
        }
}