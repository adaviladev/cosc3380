<?php

	class Package {

		public $id;
		public $userId;
		public $postOfficeId;
		public $typeId;
		public $transactionId;
		public $destinationId;
		public $returnAddressId;
		public $contents;
		public $weight;
		public $priority;
		public $packageStatus;
		public $modifiedBy;
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