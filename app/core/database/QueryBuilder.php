<?php

	/**
	 * Class QueryBuilder
	 * Used to build out query templates for common database calls.
	 */
	class QueryBuilder {

		protected $pdo;

		protected $isSingle = false;
		protected $isUpdate = false;
		protected $query = "";
		protected $table = "";
		protected $type = "";
		protected $set = "";
		protected $whereClause = "";
		protected $orderBy = "";
		protected $limitTo = "";
		protected $onDelete = "";
		protected $class = "stdClass";

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
			$this->isSingle = false;

			return $this;
		}

		public function update( $table , $bindings = [] ) {
			$this->table = $table;
			$this->type     = "UPDATE {$table}";
			$this->set      = "SET ";
			$this->isUpdate = true;
			$ctr            = 0;
			foreach( $bindings as $attr => $value ) {
				if( $ctr > 0 ) {
					$this->set .= ", ";
				}
				$this->set .= "{$attr}='{$value}'";
				$ctr++;
			}

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
		public function where( $columns = [] , $operators = [] , $values = [] , $bool = " AND " ) {
			$this->whereClause = "WHERE ";
			for( $i = 0; $i < count( $columns ); $i++ ) {
				if( $i > 0 ) {
					$this->whereClause .= $bool;
				}
				$this->whereClause .= "`{$this->table}`.`" . $columns[ $i ] . "`" . $operators[ $i ] . "'" . $values[ $i ] . "'";
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
		public function get( $ssh = false ) {
			$this->query = $this->type;
			if( $this->set != "" ) {
				$this->query .= " " . $this->set;
			}
			if( $this->whereClause != "" ) {
				$this->query .= " " . $this->whereClause;
			}
			if( $this->orderBy != "" ) {
				$this->query .= " " . $this->orderBy;
			}

			// var_dump( $this->query );

			return $this->run( $this->query , $ssh );
		}

		public function run( $sql , $ssh = false ) {
			try {
				if( $ssh ) {
					$this->pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES , true );
				}
				$statement = $this->pdo->prepare( $sql );
				$statement->execute();
				if( ! $this->isUpdate ) {
					if( ! $ssh ) {
						if( $this->isSingle ) {
							return $statement->fetchObject( $this->class );
						}

						return $statement->fetchAll( PDO::FETCH_CLASS , $this->class );
					}
					$this->pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES , false );
				}
				// return false;
			} catch( PDOException $e ) {
				die( $e->getMessage() );
			}
		}

		public function lastInsertId() {
			return $this->pdo->lastInsertId();
		}
	}