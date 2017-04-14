<?php
	getHeader();
?>
	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<?php if( ! empty( $changeFlag ) ) {
					if( $changeFlag == 3 ) { ?>
						<div class="success-message">
							Password change successful. Your new password will be available on your next log in.
						</div>
						<br/>
					<?php } else if( $changeFlag == 1 ) { ?>
						<div class="errors">
							Sorry. The new passwords you entered did not match. Please ensure they match and try again.
						</div>
						<br/>
					<?php } else if( $changeFlag == 2 ) { ?>
						<div class="errors">
							Sorry. You did not enter your old password correctly. Please try again.
						</div>
						<br/>
					<?php } ?>
				<?php } ?>
				<h2>Password Change Request</h2>

				<form action="/account/info/password" method="post">
					<div class="field-container clearfix">
						<label for="oldPassword">Old Password</label>
						<input type="password" name="oldPassword" value="">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="newPassword">New Password</label>
						<input type="password" name="newPassword" value="">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="confirmPassword">Confirm Password</label>
						<input type="password" name="confirmPassword" value="">
					</div>
					<!-- /.field-container -->
					<button type="submit">Confirm</button>
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