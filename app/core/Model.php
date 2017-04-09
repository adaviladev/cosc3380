<?php

	namespace App\Models;

	use App\Core\App;
	use Connection;
	use PDO;
	use PDOException;

	class Model {

		private $TABLE_ARRAY = [
			'Address'       => 'addresses' ,
			'Email'         => 'emails' ,
			'Package'       => 'packages' ,
			'PackageStatus' => 'packageStatus' ,
			'PackageType'   => 'packageTypes' ,
			'PostOffice'    => 'postOffices' ,
			'Role'          => 'roles' ,
			'State'         => 'states' ,
			'Transaction'   => 'transactions' ,
			'User'          => 'users' ,
		];

		public $builder;
		// protected $table;

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

		private static function init() {
			$instance          = ( new static );
			$instance->builder = Connection::make( App::get( 'config' )[ 'database' ] );

			return $instance;
		}

		/**
		 * @param string $table contains the table to search through
		 * @param array  $columns contains the columns to return
		 * @param string $class contains the class to be assigned to
		 *
		 * @return array
		 */
		public static function selectAll( $columns = [ '*' ] ) {
			/**
			 * call init() from mandatory first calls and assign params to return of init()'s $instance
			 */
			$instance        = self::init();
			$class           = get_called_class();
			$table           = $instance->TABLE_ARRAY[ $class ];
			$instance->table = $table;

			$columns   = implode( ',' ,
			                      $columns );
			$statement = $instance->builder->prepare( "select {$columns} from {$table}" );
			$statement->execute();

			return $statement->fetchAll( PDO::FETCH_CLASS ,
			                             $class );
		}

		public static function leftJoinOn( $joinedTable ,
		                                   $foreignKey ,
		                                   $primaryKey ,
		                                   $columns = [ '*' ] ) {
			$instance        = self::init();
			$class           = get_called_class();
			$table           = $instance->TABLE_ARRAY[ $class ];
			$instance->table = $table;

			$columns        = implode( ', ' ,
			                           $columns );
			$instance->type = "SELECT {$columns} FROM {$table} JOIN {$joinedTable} ON (`{$table}`.`{$foreignKey}`=`{$joinedTable}`.`{$primaryKey}`)";

			return $instance;
		}

		/**
		 * @param string $table contains the table to search through
		 * @param array  $columns contains the columns to return
		 * @param string $class contains the class to be assigned to
		 */
		public static function find( $columns = [ '*' ] ) {
			$instance        = self::init();
			$class           = get_called_class();
			$table           = $instance->TABLE_ARRAY[ $class ];
			$instance->table = $table;

			$columns            = implode( ',' ,
			                               $columns );
			$instance->type     = "SELECT {$columns} FROM {$table}";
			$instance->class    = $class;
			$instance->isSingle = true;

			return $instance;
			// return $this;
		}

		/**
		 * @param string $table contains the table to search through
		 * @param array  $columns contains columns to retrieve
		 * @param string $class contains the class to be assigned to
		 *
		 * @return $this same object for further chaining
		 */
		public static function findAll( $columns = [ '*' ] ) {
			$instance           = self::init();
			$class              = get_called_class();
			$table              = $instance->TABLE_ARRAY[ get_called_class() ];
			$instance->table    = $table;
			$columns            = implode( ',' ,
			                               $columns );
			$instance->type     = "SELECT {$columns} FROM {$table}";
			$instance->class    = $class;
			$instance->isSingle = false;

			return $instance;
		}

		/**
		 * @param array  $columns contains columns to check against
		 * @param array  $operators contains matching set of operators for each check
		 * @param array  $values contains matching set of values to check for
		 * @param string $bool conjunction to use between conditional checks
		 *
		 * @return $this
		 */
		public function where( $columns = [] ,
		                       $operators = [] ,
		                       $values = [] ,
		                       $bool = " AND " ) {
			$this->whereClause = "WHERE ";
			for( $i = 0; $i < count( $columns ); $i++ ) {
				if( $i > 0 ) {
					$this->whereClause .= $bool;
				}
				$this->whereClause .= "`{$this->table}`.`" . $columns[ $i ] . "`" . $operators[ $i ] . "'" . $values[ $i ] . "'";
			}

			return $this;
		}

		public function whereIn( $values = [] ,
		                         $column = 'id' ) {
			$values            = implode( ',' ,
			                              $values );
			$this->whereClause = "WHERE {$column} IN ({$values})";

			return $this;
		}

		public function limit( $quantity ) {
			$this->limitTo = "LIMIT {$quantity}";

			return $this;
		}

		public function orderBy( $attribute ,
		                         $direction ) {
			$this->orderBy .= "ORDER BY {$attribute} {$direction}";

			return $this;
		}

		/**
		 * @param string $table contains the table to search through
		 * @param array  $parameters $key => value pairs to insert
		 */
		public static function insert( $parameters = [] ) {
			$instance = self::init();
			$class    = get_called_class();
			$table    = $instance->TABLE_ARRAY[ $class ];
			array_keys( $parameters );
			$sql = sprintf( "INSERT INTO %s (%s) VALUES (%s)" ,
			                $table ,
			                implode( ", " ,
			                         array_keys( $parameters ) ) ,
			                ":" . implode( ", :" ,
			                               array_keys( $parameters ) ) );

			try {
				$statement = $instance->builder->prepare( $sql );
				$statement->execute( $parameters );

				return $instance->builder->lastInsertId();
			} catch( PDOException $e ) {
				return $e->getCode();
			}
		}

		public static function update( $bindings = [] ) {
			$instance           = self::init();
			$class              = get_called_class();
			$table              = $instance->TABLE_ARRAY[ $class ];
			$instance->type     = "UPDATE {$table}";
			$instance->set      = "SET ";
			$instance->isUpdate = true;
			$ctr                = 0;
			foreach( $bindings as $attr => $value ) {
				if( $ctr > 0 ) {
					$instance->set .= ", ";
				}
				$instance->set .= "{$attr}='{$value}'";
				$ctr++;
			}

			return $instance;
		}

		/**
		 * Construct the SQL query based off of previous calls
		 * @return array|mixed
		 */
		public function get() {

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
			if( $this->limitTo != "" ) {
				$this->query .= " " . $this->limitTo;
			}

			var_dump( "{$this->query}\n" );
			return $this->run( $this->query );
		}

		public function run( $sql ) {
			try {
				$statement = $this->builder->prepare( $sql );
				$statement->execute();
				if( ! $this->isUpdate ) {
					if( $this->isSingle ) {
						return $statement->fetchObject( $this->class );
					}

					return $statement->fetchAll( PDO::FETCH_CLASS ,
					                             $this->class );
				}
			} catch( PDOException $e ) {
				die( $e );
			}
		}

		public static function lastInsertId() {
			$instance = self::init();

			return $instance->builder->lastInsertId();
		}
	}