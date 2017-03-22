<?php

	/**
	 * Declare all routes here.
	 */
	$router->get( '' , 'PagesController@home' );
	$router->get( 'about' , 'PagesController@about' );
	$router->get( 'contact' , 'PagesController@contact' );
	$router->get( 'locations' , 'PagesController@locations' );
	$router->get( 'users' , 'UsersController@show' );
	$router->get( 'users/:userId' , 'UsersController@userDetail' );                         //viktor

	$router->get( 'dashboard' , 'HomeController@home' );
	$router->get( 'dashboard/packages' , 'PackageController@postOfficeInventory' );
	$router->get( 'dashboard/customers', 'UsersController@postOfficeUsers');                //viktor
	$router->get('dashboard/transactions', 'TransactionController@postOfficeTransactions');    //viktor
	$router->get( 'transactions/:transactionId', 'TransactionController@transactionDetail');    //viktor
	$router->get( 'packages' , 'PackageController@show' );
	$router->get( 'packages/:packageId' , 'PackageController@packageDetail' );

	/**
	 * Authentication routes
	 */
	$router->get( 'register' , 'AuthController@register' );
	$router->post( 'register' , 'UsersController@store' );
	$router->get( 'login' , 'AuthController@login' );
	$router->post( 'login' , 'AuthController@signIn' );
	$router->get( 'logout' , 'AuthController@logout' );

	$router->post( 'users' , 'UsersController@store' );

	/**
	 * Error out
	 */
	$router->get( '404' , 'PagesController@error' );