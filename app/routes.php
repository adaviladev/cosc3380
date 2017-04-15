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
	$router->get( 'dashboard/reports' , 'ReportsController@getReports' );
	$router->post( 'dashboard/reports' , 'ReportsController@showReports' );

	$router->get( 'dashboard/customers' , 'UsersController@postOfficeUsers' );                //viktor
	$router->get( 'dashboard/customers/:customerId' , 'UsersController@userDetail' );                //viktor
	$router->get( 'dashboard/transactions/add' , 'TransactionController@createTransaction' );
	$router->post( 'dashboard/transactions/add' , 'TransactionController@storeTransaction' );
	$router->get( 'dashboard/transactions' , 'TransactionController@postOfficeTransactions' );    //viktor
	$router->get( 'dashboard/transactions/:transactionId' , 'TransactionController@transactionDetail' );    //viktor

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

	$router->get( 'account' , 'UsersController@account' );
	$router->get( 'account/info' , 'UsersController@accountInfo' );
	$router->post( 'account/info' , 'UsersController@updateAccountInfo' );
	$router->get( 'account/packages' , 'PackageController@accountPackages' );
	$router->get( 'account/packages/:packageId' , 'PackageController@accountPackagesId' );
	$router->get( 'account/packages/cancel/:packageId' , 'PackageController@accountPackagesCancel' );
	$router->post( 'account/packages/cancel/:packageId' , 'PackageController@updatePackagesCancel' );
	$router->get( 'account/info/password' , 'UsersController@passwordChange' );
	$router->post( 'account/info/password' , 'UsersController@updatePassword' );
	$router->get( 'account/transactions' , 'TransactionController@userTransactions' );
	$router->get( 'account/transactions/:transactionId' , 'TransactionController@userTransactionDetail' );
	$router->get( 'account/transactions/edit/:transactionId' , 'TransactionController@editUserTransaction' );
	$router->post( 'account/transactions/edit/:transactionId' , 'TransactionController@editUserTransaction' );

	/**
	 * Admin routes
	 */
	$router->get( 'admin' , 'AdminController@admin' );
	$router->get( 'admin/emails' , 'AdminController@emails' );
	$router->get( 'admin/customers/:customerId' , 'AdminController@customerDetail' );
	$router->get( 'admin/users' , 'AdminController@users' );
	$router->get( 'admin/employees' , 'AdminController@employees' );
	$router->get( 'admin/employees/add' , 'UsersController@addEmployee' );
	$router->post( 'admin/employees/add' , 'AdminController@storeEmployee' );
	$router->get( 'admin/employees/:employeeId' , 'UsersController@editEmployeeDetail' );
	$router->post( 'admin/employees/:employeeId' , 'UsersController@updateEmployeeDetail' );
	$router->get( 'admin/packages' , 'AdminController@packages' );
	$router->get( 'admin/packages/:packageId' , 'PackageController@packageDetail' );
	$router->get( 'admin/post-offices' , 'AdminController@postOffices' );
	$router->get( 'admin/post-offices/:postOfficeId' , 'AdminController@selectedPostOffice' );
	$router->get( 'admin/post-offices/:postOfficeId/customers' , 'AdminController@customers' );
	$router->get( 'admin/post-offices/:postOfficeId/packages' , 'AdminController@postOfficePackages' );
	$router->get( 'admin/post-offices/:postOfficeId/employees' , 'AdminController@postOfficeEmployees' );
	$router->get( 'admin/reports' , 'ReportsController@getReports' );
	$router->post( 'admin/reports' , 'ReportsController@showReports' );
	$router->get( 'admin/transactions' , 'AdminController@transactions' );
	$router->get( 'admin/transactions/:transactionId' , 'AdminController@transactionDetail' );

	/**
	 * Error out
	 */
	$router->get( '404' , 'PagesController@error' );