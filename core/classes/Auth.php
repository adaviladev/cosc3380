<?php


	class Auth {
		protected $user;

		public static function user() {
			if( isset( $_SESSION[ 'user' ] ) ) {
				echo 'old user';
				return $_SESSION[ 'user' ];
			}

			$_SESSION[ 'user' ] = new User;
		}

		public static function login( QueryBuilder $query ) {
			// if( $user->username && $user->password ) {
			// }
			return $query->selectAll( 'users', 'User' );
		}
	}