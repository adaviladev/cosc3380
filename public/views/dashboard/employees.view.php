<?php getHeader(); ?>

<div class="row">
	<div class="container">
		<?php if( ! empty( $employees ) ) { ?>
			<div class="group-wrapper card-2 clearfix">
				<h3>Employees</h3>
				<?php getPartial( 'employeesList' , compact( 'employees' ) ); ?>
				<div class="text-right">
					<a href="/dashboard/employees/add">Add new employees</a>
				</div>
			</div>
			<!-- /.group-wrapper -->
		<?php } ?>
	</div>
</div>

<?php getFooter(); ?>