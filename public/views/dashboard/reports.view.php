<?php
	use App\Core\Auth;
	getHeader();
?>

<?php if( ! empty( $user ) ) { ?>
	<div class="row">
		<div class="container">
			<h1>Welcome, <?= $user->firstName ?> <?= $user->lastName ?></h1>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->
<?php } ?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<form action="/dashboard/reports" method="post">
					<?php if( Auth::user()->roleId === 1 ) { ?>
						<div class="col-dt-12 col-tb-12 col-tb-12">
							<div class="field-container">
								<label for="postOfficeSelector">Post Office</label>
								<select name="postOfficeSelector" id="postOfficeSelector">
									<option disabled selected value=""></option>
									<?php foreach( $postOfficees as $postOffice ) { ?>
										<option value="<?= $postOffice->id; ?>"><?= $postOffice->name; ?></option>
									<?php } ?>
								</select>
								<!-- /#packageStatusSelector -->
							</div>
							<!-- /.field-container -->
						</div>
						<!-- /.col-dt-12 col-tb-12 col-tb-12 -->
					<?php } ?>
					<div class="col-dt-12 col-tb-12 col-tb-12">
						<div class="field-container">
							<label for="packageStatusSelector">Package Status</label>
							<select name="packageStatusSelector" id="packageStatusSelector">
								<option disabled selected value=""></option>
								<?php foreach( $packageStatuses as $packageStatus ) { ?>
									<option value="<?= $packageStatus->id; ?>"><?= $packageStatus->type; ?></option>
								<?php } ?>
								<option value="all">All</option>
							</select>
							<!-- /#packageStatusSelector -->
						</div>
						<!-- /.field-container -->
					</div>
					<!-- /.col-dt-12 col-tb-12 col-tb-12 -->
					<div class="col-dt-12 col-tb-12 col-tb-12">
						<div class="field-container">
							<label for="startDate" class="filled">Start Date</label>
							<input id="startDate" name="startDate" type="date">
							<!-- /#startDate -->
						</div>
						<!-- /.field-container -->
					</div>
					<!-- /.col-dt-12 col-tb-12 col-tb-12 -->
					<div class="col-dt-12 col-tb-12 col-tb-12">
						<div class="field-container">
							<label for="endDate" class="filled">End Date</label>
							<input id="endDate" name="endDate" type="date">
							<!-- /#startDate -->
						</div>
						<!-- /.field-container -->
					</div>
					<!-- /.col-dt-12 col-tb-12 col-tb-12 -->
					<button type="submit">View Report</button>
				</form>
			</div>
			<!-- /.form-wrapper -->
			<?php
				if( !empty( $packages ) ) {
					getPartial('packagesGrid' , compact('packages' ) );
				}
			?>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php getFooter(); ?>