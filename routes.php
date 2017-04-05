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
	$router->get( 'dashboard/packages/:packageId' , 'PackageController@packageDetail' );
	$router->get( 'dashboard/packages/edit/:packageId' , 'PackageController@editPackage' );
	$router->post( 'dashboard/packages/edit/:packageId' , 'PackageController@updatePackage' );

	$router->get( 'dashboard/employees' , 'HomeController@showEmployees' );
	$router->get( 'dashboard/employees/add' , 'UsersController@addEmployee' );
	$router->post( 'dashboard/employees/add' , 'UsersController@storeEmployee' );
	$router->get( 'dashboard/employees/:employeeId' , 'UsersController@editEmployeeDetail' );
	$router->post( 'dashboard/employees/:employeeId' , 'UsersController@updateEmployeeDetail' );

	$router->get( 'dashboard/customers' , 'UsersController@postOfficeUsers' );                //viktor
	$router->get( 'dashboard/transactions' , 'TransactionController@postOfficeTransactions' );    //viktor
	$router->get( 'transactions/:transactionId' , 'TransactionController@transactionDetail' );    //viktor

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
	 * Account routes
	 */
	$router->get( 'account' , 'UsersController@account' ); //austin
	$router->get( 'account/info' , 'UsersController@accountInfo' ); //austin
	$router->get( 'account/packages' , 'PackageController@accountPackages' ); //austin
	$router->get( 'account/packages/:packageId' , 'PackageController@accountPackagesId' ); //austin
	$router->get( 'account/packages/cancel/:packageId' , 'PackageController@accountPackagesCancel' ); //austin
	$router->get( 'account/transactions' , 'TransactionController@userTransactions' );
	$router->get( 'account/transactions/:transactionId' , 'TransactionController@userTransactionDetail' );

	/**
	 * Admin routes
	 */
	$router->get( 'admin' , 'AdminController@admin' );
	$router->get( 'admin/packages' , 'AdminController@packages' );
	$router->get( 'admin/transactions' , 'AdminController@transactions' );
	$router->get( 'admin/postOffices' , 'AdminController@postOffices' );
	$router->get( 'admin/postOffices/:postOfficeId' , 'AdminController@selectedPostOffice' );

	/**
	 * Error out
	 */
	$router->get( '404' , 'PagesController@error' );