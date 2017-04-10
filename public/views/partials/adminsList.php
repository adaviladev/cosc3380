<div class="list-wrapper card-2">
	<div class="list-header primary-bg clearfix">
		<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
			<div class="list-item-content">
				<strong>Name</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
		<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
			<div class="list-item-content">
				<strong>Date Added</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
		<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
			<div class="list-item-content">
				<strong>Added By</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
		<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
			<div class="list-item-content">
				<strong>Status</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
	</div>
	<!-- /.container -->
	<div>
		<?php foreach( $admins as $admin ) { ?>
			<div class="list-item clearfix">
				<div class="list-container clearfix">
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?= $admin->firstName ?> <?= $admin->lastName ?>
							<div>
								<a href="/dashboard/employees/<?= $admin->id; ?>">Edit</a>
							</div>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?= $admin->createdAt; ?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?php
								if( ! empty($admin->addedBy) ) {
									echo $admin->addedBy->firstName . ' ' . $admin->addedBy->lastName;
								}
							?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?php if( $admin->active == 1 ) { ?>
								Active
							<?php } else { ?>
								Deleted
							<?php } ?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
				</div>
				<!-- /.list-content -->
			</div>
		<?php } ?>
	</div>
</div>
<!-- /.list-wrapper -->