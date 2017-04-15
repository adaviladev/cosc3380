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
					<fieldset>
						<legend>Report Option</legend>
						<div class="switch-toggle switch-candy">
							<input id="queryPackages" name="reportOption" type="radio" value="queryPackages" checked>
							<label for="queryPackages" onclick="">Packages</label>

							<input id="queryTransactions" name="reportOption" type="radio" value="queryTransactions">
							<label for="queryTransactions" onclick="">Transactions</label>

							<a></a>
						</div>
					</fieldset>
					<div class="group-wrapper packages-report-group">
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

					</div>
					<div class="group-wrapper transactions-report-group">
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

					</div>
					<button type="submit">View Report</button>
				</form>
			</div>
			<!-- /.form-wrapper -->
			<?php if( ! empty( $packages ) ) { ?>
				<h3><strong>Number of packages: <?= count( $packages ); ?></strong></h3>
				<?php getPartial( 'packagesGrid' , compact( 'packages' ) ); ?>
			<?php } ?>
			<?php if( ! empty( $transactions ) ) { ?>
				<h3><strong>Number of transactions: <?= count( $transactions ); ?></strong></h3>
				<?php getPartial( 'transactionsList' , compact( 'transactions' ) ); ?>
			<?php } ?>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php getFooter(); ?>