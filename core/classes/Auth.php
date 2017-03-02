<?php

	namespace App\Core;

	use QueryBuilder;

	class Auth {
		protected $user;

		public static function user() {
			if( isset( $_SESSION[ 'user' ] ) ) {
				// var_dump($_SESSION[ 'user' ]);
				return $_SESSION[ 'user' ];
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