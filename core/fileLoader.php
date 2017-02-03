<?php

	/**
	 * Keep growing this list as the application grows.
	 */
	require 'core/App.php';
	require 'core/Router.php';
	require 'core/Request.php';
	require 'core/database/Connection.php';
	require 'core/database/QueryBuilder.php';

	/**
	 * These two might need to be refactored elsewhere.
	 * Still haven't decided on how to incorporate
	 * the Auth class for logging users in.
	 */
	require 'core/classes/Auth.php';
	require 'core/classes/User.php';

	/**
	 * Add all controllers below this line
	 */
	require 'controllers/PagesController.php';
	require 'controllers/UsersController.php';