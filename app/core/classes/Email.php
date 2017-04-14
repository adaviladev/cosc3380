<?php
	/**
	 * Basic stub for storing database entities in their appropriate class
	 */

	use App\Models\Model;

	class Email extends Model {

		public $id;
		public $userId;
		public $packageId;
		public $sent;
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