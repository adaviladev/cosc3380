<?php
	use App\Core\Auth;
	getHeader();
	$emailClass = (isset($errors['email']))?'invalid':'';
?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Add an employee</h2>
				<?php if( Auth::user()->roleId == 1 ) { ?>
					<form action="/admin/employees/add" method="post">
				<?php } else { ?>
					<form action="/dashboard/employees/add" method="post">
				<?php } ?>
					<div class="field-container clearfix required">
						<label for="firstName">First Name <span>*</span></label>
						<input id="firstName" type="text" name="firstName" class="" value="" required>
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix required">
						<label for="lastName">Last name <span>*</span></label>
						<input id="lastName" type="text" name="lastName" class="" value="" required>
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix required">
						<label for="password">Password <span>*</span></label>
						<input id="password" type="password" name="password" value="" required>
					</div>
					<!-- /.field-container -->
					<div class="field-container validate clearfix required">
						<label for="email" class="email">Email <span>*</span></label>
						<input id="email" type="text" name="email" value="" class="<?= $emailClass; ?>" required>
					</div>
					<!-- /.field-container -->
					<?php if( Auth::user()->roleId == 1 ) { ?>
						<div class="field-container clearfix">
							<label for="roleSelector">Role</label>
							<?php if( ! empty( $roles ) ) { ?>
								<select name="roleId" id="roleSelector">
									<option disabled selected value=""></option>
									<?php foreach( $roles as $role ) { ?>
										<option value="<?= $role->id ?>"><?= $role->type ?></option>
									<?php } ?>
								</select>
								<!-- /#StateSelector -->
							<?php } ?>
						</div>
						<!-- /.field-container -->
					<?php } ?>
					<div class="field-container clearfix">
						<label for="address">Address</label>
						<input id="address" type="text" name="address" value="">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="city">City</label>
						<input id="city" type="text" name="city" value="">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="StateSelector">State</label>
						<?php if( ! empty( $states ) ) { ?>
							<select name="stateId" id="StateSelector">
								<option disabled selected value=""></option>
								<?php foreach( $states as $state ) { ?>
									<option value="<?= $state->id ?>"><?= $state->state ?></option>
								<?php } ?>
							</select>
							<!-- /#StateSelector -->
						<?php } ?>
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="zipCode">Zip Code</label>
						<input id="zipCode" type="text" name="zipCode" value="">
					</div>
					<!-- /.field-container -->
					<?php if( ! empty( $errors ) ) { ?>
						<div class="errors">
							<?php foreach( $errors as $error ) { ?>
								<?= $error; ?>
								<!-- /.error -->
							<?php } ?>
						</div>
					<?php } ?>
					<button type="submit">Add User</button>
				</form>
			</div>
			<!-- /.form-wrapper -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php getFooter(); ?>