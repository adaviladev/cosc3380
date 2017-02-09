<?php

	use App\Core\App;

	/**
	 * Because of the concatenation done to all files
	 * in index.php, all requires must be done
	 * based on the project root directory.
	 *
	 * New Classes must be required in core/fileLoader.php
	 */
	require 'core/fileLoader.php';

	/**
	 * Bind values to the global static App class.
	 */
	App::bind( 'config' , require 'config.php' );
	App::bind( 'database' , new QueryBuilder( Connection::make( App::get( 'config' )[ 'database' ] ) ) );

	/**
	 * List any additionaly helper functions here.
	 */
	function view( $name , $data = [] ) {
		extract( $data );

		return require "views/{$name}.view.php";
	}

	function getHeader() {
		return require_once( 'views/partials/header.php' );
	}

	function getFooter() {
		return require_once( 'views/partials/footer.php' );
	}