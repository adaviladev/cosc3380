<?php

	/**
	 * Class QueryBuilder
	 * Used to build out query templates for common database calls.
	 */
	class QueryBuilder {

		protected $pdo;

		protected $query = "";
		protected $type = "";
		protected $whereClause = "";
		protected $orderBy = "";
		protected $onDelete = "";
		protected $class = "stdClass";

		public function __construct( PDO $pdo ) {
			$this->pdo = $pdo;
		}

		public function selectAll( $table , $class = "stdClass" ) {
			$statement = $this->pdo->prepare( "select * from {$table}" );
			$statement->execute();

			return $statement->fetchAll( PDO::FETCH_CLASS , $class );
		}

		/**
		 * @param $user
		 * @param $table
		 * @param $class
		 */
		public function find( $table , $columns = ""*"" , $class = "stdClass" ) {
			$this->type = "SELECT {$columns} FROM {$table}";
			$this->class = $class;

			return $this;

			/*$sql = "SELECT * FROM {$table} WHERE";
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
			$statement->execute();

			return $statement->fetchObject( $class );*/
		}

		/**
		 * @param $user
		 * @param $table
		 * @param $class
		 */
		public function findAll( $table , $params , $class = "stdClass" ) {
			$sql = "SELECT * FROM {$table} WHERE";
			$ctr = 0;
			foreach( $params as $key => $val ) {
				if( $ctr > 0 ) {
					$sql .= " AND";
				}
				if( $key == "password" ) {
					$val = md5( $val );
				}
				$sql .= " {$key}='{$val}'";
				$ctr++;
			}

			$statement = $this->pdo->prepare( $sql );
			// $statement->setFetchMode(PDO::FETCH_CLASS, $class );
			$statement->execute();

			return $statement->fetchAll( PDO::FETCH_CLASS , $class );
		}

		/**
		 * @param $table
		 * @param $parameters
		 */
		public function insert( $table , $parameters ) {
			array_keys( $parameters );
			$sql = sprintf( "INSERT INTO %s (%s) VALUES (%s)" , $table , implode( ", " , array_keys( $parameters ) ) ,
			                ":" . implode( ", :" , array_keys( $parameters ) ) );

			try {
				$statement = $this->pdo->prepare( $sql );
				$statement->execute( $parameters );

				return true;
			} catch( PDOException $e ) {
				return $e->getCode();
			}
		}

		public function where( $columns = [] , $operators = [] , $values = [] , $bool = "AND" ) {
			$this->whereClause = "WHERE ";
			for( $i = 0; $i < count( $columns ); $i++ ) {
				$this->whereClause .= $columns[ $i ] . $operators[ $i ] . "'" . $values[ $i ] . "'";
				if( $i > 0 ) {
					$this->whereClause .= $bool[ $i - 1 ];
				}
			}

			return $this;
		}

		public function get(){
		    $this->query  = $this->type;
			if( $this->whereClause != "" ) {
				$this->query .= " " . $this->whereClause;
			}
			if( $this->orderBy != "" ) {
				$this->query .= " " . $this->orderBy;
			}

		    var_dump( $this->query );
		    $this->run( $this->query );
		}

		public function run( $sql ) {
			try {
				$statement = $this->pdo->prepare( $sql );
				$statement->execute();

				return $statement->fetchAll();
			} catch( PDOException $e ) {
				die( $e->getMessage() );
			}
		}

		public function lastInsertId() {
			return $this->pdo->lastInsertId();
		}
	}