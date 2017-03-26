<div class="list-wrapper card-2">
	<div class="list-header primary-bg clearfix">
		<div class="col-dt-3 col-tb-3 col-mb-3">
			<div class="list-item-content">
				<strong>Name</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
		<div class="col-dt-3 col-tb-3 col-mb-3">
			<div class="list-item-content">
				<strong>Date Added</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
		<div class="col-dt-3 col-tb-3 col-mb-3">
			<div class="list-item-content">
				<strong>Added By</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
	</div>
	<!-- /.container -->
	<div>
		<?php foreach( $employees as $employee ) { ?>
			<div class="list-item clearfix">
				<div class="list-container secondary-bg clearfix">
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?= $employee->firstName ?> <?= $employee->lastName ?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?= $employee->createdAt; ?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?= $employee->addedBy->firstName; ?> <?= $employee->addedBy->lastName; ?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3 text-right">
						<div class="list-item-content">
							<a href="/dashboard/employees/edit/<?= $employee->id; ?>" class="button">Edit</a>
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