<?php getHeader(); ?>

<div class="row">
	<div class="container">
		<?php if( ! empty( $employees ) ) { ?>
			<div class="group-wrapper card-2 clearfix">
				<h3>Employees</h3>
				<div class="list-wrapper">
					<div class="list-header primary-bg clearfix">
						<div class="col-dt-3 col-tb-3 col-mb-3">Name</div>
						<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
						<div class="col-dt-3 col-tb-3 col-mb-3">Date Added</div>
						<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
						<div class="col-dt-3 col-tb-3 col-mb-3">Added By</div>
						<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					</div>
					<!-- /.container -->
					<div>
						<?php foreach( $employees as $employee ) { ?>
							<div class="list-item clearfix">
								<div class="list-content secondary-bg clearfix">
									<div class="col-dt-3 col-tb-3 col-mb-3"><?= $employee->firstName ?> <?= $employee->lastName ?></div>
									<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
									<div class="col-dt-3 col-tb-3 col-mb-3"><?= $employee->createdAt; ?></div>
									<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
									<div class="col-dt-3 col-tb-3 col-mb-3"><?= $employee->addedBy->firstName; ?> <?= $employee->addedBy->lastName; ?></div>
									<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
									<div class="col-dt-3 col-tb-3 col-mb-3 text-right">
										<a href="/dashboard/employees/edit/<?= $employee->id; ?>" class="button">Edit</a>
									</div>
									<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
								</div>
								<!-- /.list-content -->
							</div>
						<?php } ?>
					</div>
				</div>
				<!-- /.list-wrapper -->
				<div class="text-right">
					<a href="/dashboard/employees/add">Add new employees</a>
				</div>
			</div>
			<!-- /.group-wrapper -->
		<?php } ?>
	</div>
</div>

<?php getFooter(); ?>