<?php getHeader(); ?>

<?php if( ! empty( $user ) ) { ?>
	<div class="row">
		<div class="container">
			<h1>Welcome, <?= $user->firstName ?> <?= $user->lastName ?></h1>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->
<?php } ?>
	<div class="row">
		<div class="container">
			<?php if( ! empty( $packages ) ) { ?>
				<div class="group-wrapper card-2 accent-bg">
					<h3>Local Packages</h3>
					<ul>
						<?php foreach( $packages as $package ) { ?>
							<li><?= $package->destination->street ?></li>
						<?php } ?>
					</ul>
				</div>
				<!-- /.group-wrapper -->
			<?php } ?>
		</div>
	</div>

	<div class="row">
		<div class="container">
			<?php if( ! empty( $employees ) ) { ?>
				<div class="group-wrapper card-2 accent-bg">
					<h3>Employees</h3>
					<ul>
						<?php foreach( $employees as $employee ) { ?>
							<li><?= $employee->firstName ?> <?= $employee->lastName ?></li>
						<?php } ?>
					</ul>
				</div>
				<!-- /.group-wrapper -->
			<?php } ?>
		</div>
	</div>

	<div class="row">
		<div class="container">
			<?php if( ! empty( $customers ) ) { ?>
				<div class="group-wrapper card-2 accent-bg">

					<h3>Customers</h3>
					<ul>
						<?php foreach( $customers as $customer ) { ?>
							<li><?= $customer->firstName ?> <?= $customer->lastName ?></li>
						<?php } ?>
					</ul>
				</div>
				<!-- /.group-wrapper -->
			<?php } ?>
		</div>
	</div>

<?php getFooter(); ?>