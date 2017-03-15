<?php

	use App\Models\Model;

	class Package extends Model {

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

		public function __sleep() {
			// silence is golden
			return [
				'id' ,
				'userId' ,
				'postOfficeId' ,
				'typeId' ,
				'transactionId' ,
				'destinationId' ,
				'returnAddressId' ,
				'contents' ,
				'weight' ,
				'priority' ,
				'packageStatus' ,
				'modifiedBy' ,
				'createdAt' ,
				'modifiedAt'
			];
		}

		public function __wakeup() {
			// silence is golden
			return [
				'id' ,
				'userId' ,
				'postOfficeId' ,
				'typeId' ,
				'transactionId' ,
				'destinationId' ,
				'returnAddressId' ,
				'contents' ,
				'weight' ,
				'priority' ,
				'packageStatus' ,
				'modifiedBy' ,
				'createdAt' ,
				'modifiedAt'
			];
		}
	}