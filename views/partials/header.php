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
						<ul class="clearfix">
							<li><a href="/users">Users</a></li>
							<li><a href="/packages">Packages</a></li>
							<?php if( empty( Auth::user() ) ) { ?>
								<li><a href="/login">Login</a></li>
								<li><a href="/register">Register</a></li>
							<?php } else { ?>
								<li><a href="/dashboard">Dashboard</a></li>
								<li><a href="/logout">Log Out</a></li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</header>
		</div>
		<div class="row">
			<div id="Content" class="container">