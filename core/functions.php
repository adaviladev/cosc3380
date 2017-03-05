<?php

	/**
	 * List any additionaly helper functions here.
	 */
	function getFooter() {
		return require_once( 'views/partials/footer.php' );
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