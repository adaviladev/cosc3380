<?php
	/**
	 * Basic stub for storing database entities in their appropriate class
	 */

	use App\Models\Model;

	class Transaction extends Model {

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

		public function __sleep() {
			// silence is golden
			return [
				'id' ,
				'customerId' ,
				'postOfficeId' ,
				'employeeId' ,
				'packageId' ,
				'cost' ,
				'createdAt' ,
				'modifiedAt'
			];
		}

		public function __wakeup() {
			// silence is golden
			return [
				'id' ,
				'customerId' ,
				'postOfficeId' ,
				'employeeId' ,
				'packageId' ,
				'cost' ,
				'createdAt' ,
				'modifiedAt'
			];
		}
	}