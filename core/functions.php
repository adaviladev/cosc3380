<?php

	/**
	 * List any additionaly helper functions here.
	 */
	function getFooter() {
		return require_once( 'views/partials/footer.php' );
	}

	function getPartial( $file , $data = [] ) {
		extract( $data );

		include( "views/partials/{$file}.php" );
	}

	function getHeader() {
		return require_once( 'views/partials/header.php' );
	}

	function redirect( $uri ) {
		header( "Location: /{$uri}" );
	}

	function view( $name , $data = [] ) {
		extract( $data );

		return require "views/{$name}.view.php";
	}

	function dd( ...$data ) {
		die( var_dump( ...$data ) );
	}