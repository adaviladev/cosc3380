<?php

	namespace App\Core;

	/**
	 * Class Request
	 * @package App\Core
	 *
	 * Returns the current URL path to the Router object.
	 */
	class Request {
		public static function uri() {
			return trim(
				parse_url( $_SERVER[ 'REQUEST_URI' ] , PHP_URL_PATH ), '/'
			);
		}

		public static function method() {
			return $_SERVER[ 'REQUEST_METHOD' ];
		}
	}