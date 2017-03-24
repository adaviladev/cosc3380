<?php

	use App\Core\Auth;

?>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" href="/views/assets/bundle/css/all.min.css">
	</head>

	<body>
		<div class="row nav-menu card clearfix">
			<header class="card primary-bg">
				<div class="container clearfix">
					<a href="/" id="Logo">
						Home
					</a>
					<nav>
						<ul class="clearfix menu">
							<li class="parent-menu"><a href="/users">Users</a></li>
							<li class="parent-menu"><a href="/locations">Locations</a></li>
							<?php if( empty( Auth::user() ) ) { ?>
								<li class="parent-menu"><a href="/login">Login</a></li>
								<li class="parent-menu"><a href="/register">Register</a></li>
							<?php } else if (Auth::user() && Auth::user()->roleId == 2) { ?>
								<li class="parent-menu">
									<a href="/dashboard">Dashboard</a>
									<ul class="sub-menu">
										<li class="">
											<a href="/dashboard/packages">Packages</a>
										</li>
										<li class="">
											<a href="/dashboard/customers">Customers</a>
										</li>
										<li class="">
											<a href="/dashboard/transactions">Transactions</a>
										</li>
									</ul>
								</li>
							<?php } else if (Auth::user() && Auth::user()->roleId == 3) { ?>
								<li class="parent-menu"><a href="/account">Account</a></li>
							<!-- we need to change this to redirect to the page that Andres made/makes -->
							<?php } ?>
							<?php if(Auth::user()) {?>
								<li class="parent-menu"><a href="/logout">Log Out</a></li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</header>
		</div>
		<div class="row">
			<div id="Content" class="">