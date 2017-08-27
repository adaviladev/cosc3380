<?php
	/**
	 * Basic stub for storing database entities in their appropriate class
	 */

	namespace App\Core;

	use QueryBuilder;
    use User;

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
//            $_SESSION['user'] = serialize(User::find()->where(['id'],['='],[1])->get());
            return User::find()->where(['id'],['='],[1])->get();
//			if( isset( $_SESSION[ 'user' ] ) ) {
//
//				return unserialize( $_SESSION[ 'user' ] );
//			}

			// $_SESSION[ 'user' ] = new User;
			return false;
		}

		public static function login( QueryBuilder $query ) {
			// if( $user->username && $user->password ) {
			// }
			return $query->selectAll( 'users' );
		}
	}