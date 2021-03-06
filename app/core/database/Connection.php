<?php

	/**
	 * Class Connection
	 * Returns a PDO connection for querying the database
	 */
	class Connection {
		public static function make( $config ) {
			try {
				return new PDO(
					$config[ 'connection' ] . ';dbname=' . $config['name'],
					$config[ 'username' ],
					$config[ 'password' ],
					$config[ 'options' ]
				);
			} catch( PDOException $exception ) {
				die( $exception->getMessage() );
			}
		}
	}