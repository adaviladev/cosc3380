<?php
	/**
	 * Basic stub for storing database entities in their appropriate class
	 */

	use App\Models\Model;

	class User extends Model {
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

		public function __sleep() {
			// silence is golden
			return [
				'id' ,
				'firstName' ,
				'lastName' ,
				'addressId' ,
				'email' ,
				'password' ,
				'roleId' ,
				'postOfficeId' ,
				'modifiedBy' ,
				'createdAt' ,
				'createdBy' ,
				'modifiedAt'
			];
		}

		public function __wakeup() {
			// silence is golden
			return [
				'id' ,
				'firstName' ,
				'lastName' ,
				'addressId' ,
				'email' ,
				'password' ,
				'roleId' ,
				'postOfficeId' ,
				'modifiedBy' ,
				'createdAt' ,
				'createdBy' ,
				'modifiedAt'
			];
		}
	}