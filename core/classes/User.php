<?php

	namespace App\Core;

	class User {
		public $id;
		public $firstName;
		public $lastName;
		public $addressId;
		public $email;
		public $roleId;
		public $postOfficeId;
		public $modifiedBy;
		public $createdAt;
		public $createdBy;
		public $modifiedAt;

		public function __construct() {
			// silence is golden
		}
	}