<?php

	/**
	 * List any additionaly helper functions here.
	 */
	function getFooter() {
		return require_once( __DIR__ . "/../../public/views/partials/footer.php" );
	}

	function getPartial( $file , $data = [] ) {
		extract( $data );

		require( __DIR__ . "/../../public/views/partials/{$file}.php" );
	}

	function getHeader() {
		return require_once( __DIR__ . "/../../public/views/partials/header.php" );
	}

	function redirect( $uri ) {
		header( "Location: /{$uri}" );
	}

	function view( $name , $data = [] ) {
		extract( $data );

		return require __DIR__ . "/../../public/views/{$name}.view.php";
	}

	function dd( ...$data ) {
		die( var_dump( ...$data ) );
	}