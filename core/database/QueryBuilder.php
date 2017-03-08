<?php

	/**
	 * Class QueryBuilder
	 * Used to build out query templates for common database calls.
	 */
	class QueryBuilder {

		protected $pdo;

		private $isSingle = false;
		private $query = "";
		private $type = "";
		private $whereClause = "";
		private $orderBy = "";
		private $limitTo = "";
		private $onDelete = "";
		private $class = "stdClass";

		public function __construct( PDO $pdo ) {
			$this->pdo = $pdo;
		}

		/**
		 * @param string $table contains the table to search through
		 * @param array  $columns contains the columns to return
		 * @param string $class contains the class to be assigned to
		 *
		 * @return array
		 */
		public function selectAll( $table , $columns = [ '*' ] , $class = "stdClass" ) {
			$columns   = implode( ',' , $columns );
			$statement = $this->pdo->prepare( "select {$columns} from {$table}" );
			$statement->execute();

			return $statement->fetchAll( PDO::FETCH_CLASS , $class );
		}

		/**
		 * @param string $table contains the table to search through
		 * @param array  $columns contains the columns to return
		 * @param string $class contains the class to be assigned to
		 */
		public function find( $table , $columns = [ '*' ] , $class = "stdClass" ) {
			$columns        = implode( ',' , $columns );
			$this->type     = "SELECT {$columns} FROM {$table}";
			$this->class    = $class;
			$this->isSingle = true;

			return $this;
		}

		/**
		 * @param string $table contains the table to search through
		 * @param array  $columns contains columns to retrieve
		 * @param string $class contains the class to be assigned to
		 *
		 * @return $this same object for further chaining
		 */
		public function findAll( $table , $columns = [ '*' ] , $class = "stdClass" ) {
			$columns        = implode( ',' , $columns );
			$this->type     = "SELECT {$columns} FROM {$table}";
			$this->class    = $class;
			$this->isSingle = true;

			return $this;
		}

		/**
		 * @param array  $columns contains columns to check against
		 * @param array  $operators contains matching set of operators for each check
		 * @param array  $values contains matching set of values to check for
		 * @param string $bool conjunction to use between conditional checks
		 *
		 * @return $this
		 */
		public function where( $columns = [] , $operators = [] , $values = [] , $bool = "AND" ) {
			$this->whereClause = "WHERE ";
			for( $i = 0; $i < count( $columns ); $i++ ) {
				$this->whereClause .= $columns[ $i ] . $operators[ $i ] . $values[ $i ];
				if( $i > 0 ) {
					$this->whereClause .= $bool[ $i - 1 ];
				}
			}

			return $this;
		}

		/**
		 * @param string $table contains the table to search through
		 * @param array  $parameters $key => value pairs to insert
		 */
		public function insert( $table , $parameters = [] ) {
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

		/**
		 * Construct the SQL query based off of previous calls
		 * @return array|mixed
		 */
		public function get() {
			$this->query = $this->type;
			if( $this->whereClause != "" ) {
				$this->query .= " " . $this->whereClause;
			}
			if( $this->orderBy != "" ) {
				$this->query .= " " . $this->orderBy;
			}

			var_dump( $this->query );

			return $this->run( $this->query );
		}

		public function run( $sql ) {
			try {
				$statement = $this->pdo->prepare( $sql );
				$statement->execute();
				if( $this->isSingle ) {
					return $statement->fetchObject( $this->class );
				}

				return $statement->fetchAll( PDO::FETCH_CLASS , $this->class );
			} catch( PDOException $e ) {
				die( $e->getMessage() );
			}
		}

		public function lastInsertId() {
			return $this->pdo->lastInsertId();
		}
	}