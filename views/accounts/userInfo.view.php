<?php
	getHeader();
?>

<div class="row">
	<div class="container">
		<h1>User Info</h1>
	</div>
</div>

<?php if( ! empty( $user ) ) { ?>
	<div class="row">
		<div class="container">
			<h1>test</h1>
		</div>
	</div>
<?php } ?>

<?php if( ! empty( $user ) ) { ?>
	<div class="row">
		<div class="container">
			<h2>Welcome, <?= $user->firstName ?> <?= $user->lastName ?></h2>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->
<?php } ?>

<?php
	getFooter();
?>
