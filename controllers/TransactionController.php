<?php

	namespace App\Controllers;

	use Address;
	use User;
	use App\Core\App;
	use App\Core\Auth;
	use Transaction;

	class TransactionController {

		public function show() {
			$transactions = Transaction::selectAll();
			return view('index', compact('transactions'));
		}
		public function postOfficeTransactions() {
			$user = Auth::user();
			$user->postOfficeId;
			$transactions = Transaction::findAll()->where(['postOfficeId'],
			                                                             ['='],
			                                                             [$user->postOfficeId])->get();
			echo 'viktor was here';
			//dd($transactions);
			return view('dashboard/transactions',
			            compact('transactions'));
		}

		public function transactionDetail( $userId) {
			$transaction = Transaction::find()->where(['id'], ['='], [$userId])->get();
			return view('dashboard/transactionDetail', compact ('transaction'));
	}























	}



