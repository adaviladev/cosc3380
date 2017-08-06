<?php
	use App\Core\Auth;
	$user = Auth::user();
?>
<!doctype html>
<html>
	<head>
		<title>ProstOffice - The Number One Fake Postal Service!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/assets/bundle/css/all.min.css">
	</head>

	<body class="card">
		<?php getPartial( 'nav' ) ?>
		<div id="ContentWrapper">
			<div class="row nav-menu card clearfix">
				<header class="card primary-bg">
					<button class="nav-trigger float-right primary-bg"><span>toggle</span></button>
					<div class="container clearfix">
						<div class="float-left">
							<?php if( !$user ) { ?>
								<a href="/" id="Logo">
							<?php } else if( $user->roleId == 1 ) { ?>
								<a href="/admin" id="Logo">
							<?php } else if( $user->roleId == 2 ) { ?>
								<a href="/dashboard" id="Logo">
							<?php } else if( $user->roleId == 3 ) { ?>
								<a href="/account" id="Logo">
							<?php } ?>
								<img src="/views/assets/images/prostoffice-dark.png" alt="">
							</a>
						</div>

					</div>
				</header>
			</div>
			<div class="row">
				<div id="Content" class="">