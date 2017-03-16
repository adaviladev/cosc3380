<?php

	use App\Core\Auth;

?>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" href="/views/assets/css/main.css">
	</head>

	<body>
		<div class="row nav-menu card clearfix">
			<header class="card">
				<div class="container clearfix">
					<a href="/" id="Logo">
						Home
					</a>
					<nav>
						<ul class="clearfix menu">
							<li class="parent-menu"><a href="/users">Users</a></li>
							<li class="parent-menu"><a href="/locations">Locations</a></li>
							<?php if( empty( Auth::user() ) ) { ?>
								<li class="parent-menu"><a href="/packages">Packages</a></li>
								<li class="parent-menu"><a href="/login">Login</a></li>
								<li class="parent-menu"><a href="/register">Register</a></li>
							<?php } else { ?>
								<li class="parent-menu">
									<a href="/dashboard">Dashboard</a>
									<ul class="sub-menu">
										<li class="">
											<a href="/dashboard/packages">Packages</a>
										</li>
										<li class="">
											<a href="/dashboard/customers">Customers</a>
										</li>
									</ul>
								</li>
								<li class="parent-menu"><a href="/logout">Log Out</a></li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</header>
		</div>
		<div class="row">
			<div id="Content" class="container">