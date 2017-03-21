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
					<div>
						<?php foreach( $employees as $employee ) { ?>
							<div class="list-item card-2 col-dt-4 col-tb-6 col-mb-12 secondary-bg">
								<p><strong><?= $employee->firstName ?> <?= $employee->lastName ?></strong></p>
								<p>Added: <?= $employee->createdAt; ?></p>
							</div>
						<?php } ?>
					</div>
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