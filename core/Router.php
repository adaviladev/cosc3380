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
			/**
			 * TODO
			 * Need to add functionality for handling paramaters in the path
			 */
			// var_dump( $uri );
			// $breadcrumbs = explode( '/:' , $uri );
			// // echo $breadcrumbs;
			// if( isset( $breadcrumbs[ 1 ] ) ) {
			// 	echo '<pre>';
			// 	print_r( $breadcrumbs );
			// 	echo '</pre>';
			// }

			// $this->routes[ 'GET' ][ $uri ] = array(
			// 	'controller' => $controller,
			// 	'parameters' => ($breadcrumbs[1] ? $breadcrumbs[1]: null),
			// );
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

			/*var_dump( 'start foreach' );
			foreach( $this->routes[ $requestType ] as $route => $controller) {
				echo $route . '<br/>';
				$patternStr = explode( '/' , $route );
				var_dump( $patternStr );
				$regex = '/';
				$ctr = 0;
				foreach( $patternStr as $pattern ) {
					if( $pattern === '' ) {
						continue;
					}
					if( $ctr > 0 ) {
						$regex .= "\/";
					}
					$regex .= "(?P<" . $pattern . ">)";
					$ctr++;
				}
				$regex .= "/";
				if(
				preg_match($regex, $route, $matches) ) {
					var_dump( 'match at ' . $route  . ' || ' . $uri);
					// return $this->callAction( ...explode( '@' , $this->routes[ $requestType ][ $uri ] , $matches ) );
				}
			}
			var_dump( $matches );
			var_dump( $this->routes );*/

			throw new Exception( 'No route defined for URI.' );
		}

		protected function callAction( $controller , $method , $params = [] ) {
			$controller = "App\\Controllers\\{$controller}";
			$controller = new $controller;

			var_dump( $controller , $method , $params );
			if( ! method_exists( $controller , $method ) ) {
				throw new Exception( "Controller {$controller} does not have method {$method}()." );
			}

			return $controller->$method( $params );
		}
	}