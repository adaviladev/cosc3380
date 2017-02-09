<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<div class="package-wrapper">
				<div class="package-list-item clearfix">
					<div class="one_fifth float-left text-center">
						<?= $package->id ?>
					</div>
					<!-- /.one_fifth float-left -->
					<div class="one_fifth float-left text-center">
						<?= $package->user_id ?>
					</div>
					<!-- /.one_fifth float-left -->
					<div class="one_fifth float-left">
						<?= $package->user->username ?>
					</div>
					<!-- /.one_fifth float-left -->
					<div class="one_fifth float-left">
						<?= $package->destination ?>
					</div>
					<!-- /.one_fifth float-left -->
					<div class="one_fifth float-left text-center">
						<?= $package->status ?>
					</div>
					<!-- /.one_fifth float-left -->
				</div>
			</div>
		</div>
	</div>

<?php getFooter(); ?>