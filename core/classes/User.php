<?php

	class User {
		public $id;
		public $firstName;
		public $lastName;
		public $addressId;
		public $email;
		public $password;
		public $roleId;
		public $postOfficeId;
		public $modifiedBy;
		public $createdAt;
		public $createdBy;
		public $modifiedAt;

		public function __construct() {
			// silence is golden
		}

		public function  __sleep(){
			// silence is golden
			return [
				'id',
				'firstName',
				'lastName',
				'addressId',
				'email',
				'password',
				'roleId',
				'postOfficeId',
				'modifiedBy',
				'createdAt',
				'createdBy',
				'modifiedAt'
			];
		}

		public function  __wakeup(){
			// silence is golden
			return [
				'id',
				'firstName',
				'lastName',
				'addressId',
				'email',
				'password',
				'roleId',
				'postOfficeId',
				'modifiedBy',
				'createdAt',
				'createdBy',
				'modifiedAt'
			];
		}
	}