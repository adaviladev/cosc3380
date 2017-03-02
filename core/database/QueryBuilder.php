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
		 * @param $user
		 * @param $table
		 * @param $class
		 */
		public function find( $table , $params , $class = 'stdClass' ) {
			$sql = "SELECT * FROM {$table} WHERE";
			$ctr = 0;
			foreach( $params as $key => $val ) {
				if( $ctr > 0 ) {
					$sql .= " AND";
				}
				if( $key == 'password' ) {
					$val = md5( $val );
				}
				$sql .= " {$key}='{$val}'";
				$ctr++;
			}

			$statement = $this->pdo->prepare( $sql );
			$statement->setFetchMode(PDO::FETCH_CLASS, $class );
			$statement->execute();

			return $statement->fetch();
		}

		/**
		 * @param $user
		 * @param $table
		 * @param $class
		 */
		public function findAll( $table , $params , $class = 'stdClass' ) {
			$sql = "SELECT * FROM {$table} WHERE";
			$ctr = 0;
			foreach( $params as $key => $val ) {
				if( $ctr > 0 ) {
					$sql .= " AND";
				}
				if( $key == 'password' ) {
					$val = md5( $val );
				}
				$sql .= " {$key}='{$val}'";
				$ctr++;
			}

			$statement = $this->pdo->prepare( $sql );
			$statement->setFetchMode(PDO::FETCH_CLASS, $class );
			$statement->execute();

			return $statement->fetchAll();
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

		public function run( $sql ){
			try {
				$statement = $this->pdo->prepare( $sql );
				$statement->execute();
			} catch( PDOException $e ) {
				die( $e->getMessage() );
			}
		}
	}