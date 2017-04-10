<?php

	use App\Models\Model;

	class Address extends Model {

		public $id;
		public $street;
		public $city;
		public $stateId;
		public $zipCode;
		public $createdAt;
		public $modifiedAt;

		public function __construct() {
			// silence is golden
		}

		public function __sleep() {
			// silence is golden
			return [
				'id' ,
				'street' ,
				'city' ,
				'stateId' ,
				'zipCode' ,
				'createdAt' ,
				'modifiedAt'
			];
		}

		public function __wakeup() {
			// silence is golden
			return [
				'id' ,
				'street' ,
				'city' ,
				'stateId' ,
				'zipCode' ,
				'createdAt' ,
				'modifiedAt'
			];
		}
	}