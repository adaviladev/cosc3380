<?php

	namespace App\Core;

	use QueryBuilder;

	class Auth {
		protected $user;

		public function  __sleep(){
			// silence is golden
		}

		public function  __wakeup(){
			// silence is golden
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