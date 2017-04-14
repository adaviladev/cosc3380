<?php
	/**
	 * Basic stub for storing database entities in their appropriate class
	 */

	namespace App\Core;

	use QueryBuilder;

	class Auth {
		protected $user;

		public function  __sleep(){
			// silence is golden
			return [ 'user' ];
		}

		public function  __wakeup(){
			// silence is golden
			return [ 'user' ];
		}

		public static function user() {
			if( isset( $_SESSION[ 'user' ] ) ) {

				return unserialize( $_SESSION[ 'user' ] );
			}

			// $_SESSION[ 'user' ] = new User;
			return false;
		}

		public static function login( QueryBuilder $query ) {
			// if( $user->username && $user->password ) {
			// }
			return $query->selectAll( 'users' );
		}
	}