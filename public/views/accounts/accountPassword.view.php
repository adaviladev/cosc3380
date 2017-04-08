<?php
	getHeader();
?>
	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Password Change Request</h2>

				<form action="/account/info/password" method="post"> <!-- change /register -->
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