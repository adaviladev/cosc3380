<?php getHeader();
	$emailClass = ( isset( $errors[ 'email' ] ) ) ? 'invalid' : '';
?>

	<!-- HEADING TESTING
	<div class="row">
		<div class="container">
			<h1>Contact Page</h1>
		</div>
	</div>
	HEADING TESTING END -->


	<!-- BUTTON IDEA TESTING
	<div class="container">
		<div class="drop-down">
			<button class="drop-button">Location</button>
			<div class="drop-down-content">
				<?php if( ! empty( $postOffices ) ) { ?>
					<?php foreach( $postOffices as $postOffice ) { ?>
						<a href="#"><?= $postOffice->name; ?></a>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
	END OF BUTTON IDEA TESTING-->

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Contact Us</h2>
				<form action="/contact" method="post">
					<div class="field-container clearfix">
						<label>First Name</label>
						<input type="text" name="" class="" value="">
					</div>
					<div class="field-container clearfix">
						<label>Last Name</label>
						<input type="text" name="" class="" value="">
					</div>
					<div class="field-container clearfix">
						<label>Email</label>
						<input type="text" name="" class="" value="">
					</div>
					<div class="field-container clearfix">
						<label>Your Local ProstOffice (Optional)</label>
						<?php if( ! empty( $postOffices ) ) { ?>
							<select>
								<option disabled selected value=""></option>
								<?php foreach( $postOffices as $postOffice ) { ?>
									<option value="<?= $postOffice->name; ?>"><?= $postOffice->name; ?></option>
								<?php } ?>
							</select>
						<?php } ?>
					</div>
					<div class="field-container clearfix">
						<label>What is your question or comment?</label>
					</div>
					<div class="field-container clearfix">
						<textarea type="text" name="" class="" value=""></textarea>
					</div>
					<button type="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>


<?php getFooter(); ?>