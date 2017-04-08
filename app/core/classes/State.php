<?php

	use App\Models\Model;

	class State extends Model {

		public $id;
		public $state;

		public function __construct() {
			// silence is golden
		}

		public function __sleep() {
			// silence is golden
			return [ 'id' , 'state' ];
		}

		public function __wakeup() {
			// silence is golden
			return [ 'id' , 'state' ];
		}
	}