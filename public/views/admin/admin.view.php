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
				<div class="group-wrapper card-2">
					<h3>Local Packages</h3>
					<?php getPartial( "packagesGrid" , compact( 'packages' ) ); ?>
					<div class="text-right">
						<a href="/admin/packages">View all packages</a>
					</div>
					<!-- /.text-right -->
				</div>
				<!-- /.group-wrapper -->
			<?php } ?>
		</div>
	</div>

	<div class="row">
		<div class="container">
			<?php if( ! empty( $admins ) ) { ?>
				<div class="group-wrapper card-2 clearfix">
					<h3>Admins</h3>
					<?php getPartial( 'adminsList' , compact( 'admins' ) ); ?>
					<div class="text-right">
						<a href="/admin/users">View all admins</a>
					</div>
				</div>
				<!-- /.group-wrapper -->
			<?php } ?>
		</div>
	</div>

	<div class="row">
		<div class="container">
			<?php if( ! empty( $customers ) ) { ?>
				<div class="group-wrapper card-2">

					<h3>Customers</h3>
					<ul>
						<?php foreach( $customers as $customer ) { ?>
							<li><?= $customer->firstName; ?> <?= $customer->lastName; ?> - <?= $customer->packageCount; ?></li>
						<?php } ?>
					</ul>
					<div class="text-right">
						<a href="/admin/customers">View all customers</a>
					</div>
					<!-- /.text-right -->
				</div>
				<!-- /.group-wrapper -->
			<?php } ?>
		</div>
	</div>

<?php getFooter(); ?>