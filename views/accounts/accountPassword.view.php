<?php
	getHeader();
?>
	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Password Change Request</h2>
				<form action="/register" method="post"> <!-- change /register -->
					<div class="field-container clearfix">
						<label for="password">New Password</label>
						<input type="password" name="password" value="">
					</div>
				                                        <!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="password">Confirm Password</label>
						<input type="password" name="password" value="">
					</div>
				                                        <!-- /.field-container -->
					<button type="button">Confirm</button>
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