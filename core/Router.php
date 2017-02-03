<?php

	namespace App\Core;

	use Exception;

	/**
	 * Class Router
	 * @package App\Core
	 *
	 * The Router class is the junction of application.
	 * It determines which controllers and methods need to be called.
	 */
	class Router {

		/**
		 * Routes are separated into their respective
		 * request methods.
		 */
		protected $routes = [
			'GET'  => [] ,
			'POST' => []
		];

		public static function load( $file ) {
			$router = new self;
			require $file;

			return $router;
		}

		/**
		 * Called from ./routes.php
		 */
		public function get( $uri , $controller ) {
			$this->routes[ 'GET' ][ $uri ] = $controller;
		}

		/**
		 * Called from ./routes.php
		 */
		public function post( $uri , $controller ) {
			$this->routes[ 'POST' ][ $uri ] = $controller;
		}

		public function direct( $uri , $requestType ) {

			if( array_key_exists( $uri , $this->routes[ $requestType ] ) ) {

				return $this->callAction( ...explode( '@' , $this->routes[ $requestType ][ $uri ] ) );
			}

			throw new Exception( 'No route defined for URI.' );
		}

		protected function callAction( $controller , $method ) {
			$controller = "App\\Controllers\\{$controller}";
			$controller = new $controller;

			if( ! method_exists( $controller , $method ) ) {
				// throw new Exception( "Controller {$controller} does not have method {$method}()." );
			}

			return $controller->$method();
		}
	}