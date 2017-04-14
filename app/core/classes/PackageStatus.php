<?php
	/**
	 * Basic stub for storing database entities in their appropriate class
	 */

	use App\Models\Model;

	class PackageStatus extends Model {

		public $id;
		public $type;
		public $modifiedBy;
		public $createdAt;
		public $modifiedAt;

		public function __construct() {
			// silence is golden
		}

		public function __sleep() {
			// silence is golden
			return [
				'id' ,
				'type' ,
				'modifiedBy' ,
				'createdAt' ,
				'modifiedAt'
			];
		}

		public function __wakeup() {
			// silence is golden
			return [
				'id' ,
				'type' ,
				'modifiedBy' ,
				'createdAt' ,
				'modifiedAt'
			];
		}
	}