<?php

	/**
	 * These two might need to be refactored elsewhere.
	 * Still haven't decided on how to incorporate
	 * the Auth class for logging users in.
	 */
	foreach( glob( "core/classes/*.php" ) as $file ) {
		require_once $file;
	}

	/**
	 * Keep growing this list as the application grows.
	 */
	require 'core/App.php';
	require 'core/Router.php';
	require 'core/Request.php';
	require 'core/database/Connection.php';
	require 'core/database/QueryBuilder.php';

	/**
	 * Auto-require all controllers in controllers directory
	 */
	foreach( glob( "controllers/*.php" ) as $file ) {
		require_once $file;
	}
