<?php

	class User {
		public $id;
		public $username;
		public $password;
		public $role;
		public $created_at;
		public $updated_at;
		public $last_login;

		public function __construct() {
			// silence is golden
		}
	}