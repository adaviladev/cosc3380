<?php getHeader();
	if(isset($_POST['submit'])){
		$to = "#@gmail.com"; // this is your Email address
		$from = $_POST['Email']; // this is the sender's Email address
		$first_name = $_POST['FirstName'];
		$last_name = $_POST['LastName'];
		$subject = "Form submission";
		$subject2 = "Copy of your form submission";
		$message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['Message'];
		$message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['Message'];

		$headers = "From:" . $from;
		$headers2 = "From:" . $to;
		mail($to,$subject,$message,$headers);
		mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
		echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
	}
?>
	<!-- View for /contact page, this view allows any user (logged in or not) to
	send a question/comment to the assigned email address for contact at prostoffice.pro-->
	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Contact Us</h2>
				<!-- Input begins -->
				<form action="" method="post">
					<div class="field-container clearfix">
						<label for="FirstName">First Name</label>
						<input id="FirstName" type="text" name="FirstName" class="" value="" required>
					</div>
					<div class="field-container clearfix">
						<label for="LastName">Last Name</label>
						<input id="LastName" type="text" name="LastName" class="" value="" required>
					</div>
					<div class="field-container clearfix">
						<label for="Email">Email</label>
						<input id="Email" type="text" name="Email" class="" value="" required>
					</div>
					<div class="field-container clearfix">
						<label for="postOfficeSelector">Your Local ProstOffice (Optional)</label>
						<?php if( ! empty( $postOffices ) ) { ?>
							<select id="postOfficeSelector" name="postOfficeSelector" required>
								<option disabled selected value=""></option>
								<?php foreach( $postOffices as $postOffice ) { ?>
									<option name="PostOffice" value="<?= $postOffice->name; ?>"><?= $postOffice->name; ?></option>
								<?php } ?>
							</select>
						<?php } ?>
					</div>
					<div class="field-container clearfix">
						<!-- Text area -->
						<label for="Message">What is your question or comment?</label>
						<textarea id="Message" type="text" name="Message" class="" value="" required></textarea>
					</div>
					<button type="submit" name="submit" value="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>


<?php getFooter(); ?>