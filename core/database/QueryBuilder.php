<?php

	/**
	 * Class QueryBuilder
	 * Used to build out query templates for common database calls.
	 */
	class QueryBuilder {

		protected $pdo;

		public function __construct( PDO $pdo ) {
			$this->pdo = $pdo;
		}

		public function selectAll( $table , $class = 'stdClass' ) {
			$statement = $this->pdo->prepare( "select * from {$table}" );
			$statement->execute();

			return $statement->fetchAll( PDO::FETCH_CLASS , $class );
		}

		/**
		 * Need to change this to accept a column parameter
		 * along with a value so we can search on any field.
		 *
		 * @param $user
		 * @param $table
		 * @param $class
		 */
		public function find( $user , $table , $class ) {
			$statement = $this->pdo->prepare( "select * from {$table} WHERE username = {$user->username} AND password = bcrypt({$user->password})" );
			$statement->execute();

			var_dump( $statement->fetch( PDO::FETCH_CLASS , $class ) );
		}

		/**
		 * @param $table
		 * @param $parameters
		 */
		public function insert( $table , $parameters ) {
			array_keys( $parameters );
			$sql = sprintf( 'insert into %s (%s) values (%s)' , $table , implode( ', ' , array_keys( $parameters ) ) ,
			                ':' . implode( ', :' , array_keys( $parameters ) ) );

			try {
				$statement = $this->pdo->prepare( $sql );
				$statement->execute( $parameters );
			} catch( PDOException $e ) {
				die( $e->getMessage() );
			}
		}
	}