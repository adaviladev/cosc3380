<?php

	class Address {

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

		public function  __sleep(){
			// silence is golden
		}

		public function  __wakeup(){
			// silence is golden
		}
	}