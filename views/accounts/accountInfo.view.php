

<?php //dd($userState);
	getHeader();
	$emailClass = (isset($errors['email']))?'invalid':'';
?>



<div class="row">
	<div class="container">
		<div class="form-wrapper">
			<h2>Account Info</h2>
			<form action="/register" method="post"> <!-- change /register -->
				<div class="field-container clearfix">
					<label for="firstName">First Name</label>
					<input type="text" name="firstName" class="" value= <?=$user->firstName?>>
				</div>
				<!-- /.field-container -->
				<div class="field-container clearfix">
					<label for="lastName">Last name</label>
					<input type="text" name="lastName" class="" value=<?=$user->lastName?>>
				</div>
				<!-- /.field-container -->
				<div class="field-container validate clearfix">
					<label for="email" class="email">Email</label>
					<input type="text" name="email" value=<?=$user->email?> class="<?= $emailClass; ?>">
				</div>
				<!-- /.field-container -->
				<div class="field-container clearfix">
					<label for="address">Address</label>
					<input type="text" name="address" value=<?=$address->street?>>
				</div>
				<!-- /.field-container -->
				<div class="field-container clearfix">
					<label for="city">City</label>
					<input type="text" name="city" value=<?=$address->city?>>
				</div>
				<!-- /.field-container -->
				<div class="field-container clearfix">
					<label for="StateSelector">State</label>
					<?php if( ! empty( $states ) ) { ?>
						<select name="stateId" id="StateSelector">
							<option selected value=<?=$userState->state?>></option>
							<?php foreach( $states as $state ) { ?>
								<option value="<?= $state->id ?>"><?= $state->state ?></option>
							<?php } ?>
						</select>
					<?php } ?>
				</div>
				<!-- /.field-container -->
				<!-- /#StateSelector -->
				<div class="field-container clearfix">
					<label for="zipCode">Zip Code</label>
					<input type="text" name="zipCode" value=<?=$address->zipCode?>>
				</div>
				<!-- /.field-container -->
				<button type="submit">Change Info</button>
				<button type="button">Change Password</button>
			</form>
		</div>
		<!-- /.form-wrapper -->
	</div>
	<!-- /.container -->
</div>
<!-- /.row -->

<?php
	getFooter();
?>
