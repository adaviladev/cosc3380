<?php

	class Transaction {

		public $id;
		public $customerId;
		public $postOfficeId;
		public $employeeId;
		public $packageId;
		public $cost;
		public $createdAt;
		public $modifiedAt;

		public function __construct() {
			// silence is golden
		}

		public function  __sleep(){
			// silence is golden
		}

		public function  __wakeup(){
			// silence is golden
		}
	}