<?php
	use App\Core\Auth;
	getHeader();
?>

<div class="row">
	<div class="container">
		<?php if( ! empty( $employees ) ) { ?>
			<div class="group-wrapper card-2 clearfix">
				<h3>Employees</h3>
				<?php getPartial( 'employeesList' , compact( 'employees' ) ); ?>
				<div class="text-right">
					<?php if( Auth::user()->roleId === 1 ) { ?>
						<a href="/dashboard/employees/add">Add new User</a>
					<?php } else { ?>
						<a href="/dashboard/employees/add">Add new employees</a>
					<?php } ?>
				</div>
			</div>
			<!-- /.group-wrapper -->
		<?php } ?>
	</div>
</div>

<?php getFooter(); ?>