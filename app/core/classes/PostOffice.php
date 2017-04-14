<?php
	/**
	 * Basic stub for storing database entities in their appropriate class
	 */

	use App\Models\Model;

	class PostOffice extends Model {

		public $id;
		public $name;
		public $address;
		public $city;
		public $stateId;
		public $zipCode;
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