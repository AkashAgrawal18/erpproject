<?php $this->view('header'); ?>

<?php $roll_id = $this->session->userdata('roll_id');
	$logged_user_type = $this->session->userdata('user_type');

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-6">
					<?php if ($logged_user_type == 1 || has_perm($roll_id, 'FNC', 'ASLR', 'Filter')) { ?>
						<form method="post" action="<?php echo site_url('Report/emp_add_salary') ?>">
							<div class="row">
								<div class="col-sm-6">
									<label class="form-check-label">Month</label>
									<input type="month" name="from_month" value="<?php echo $from_month; ?>">
								</div>

								<div class="col-sm-4">
									<div class="form-group">
										<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
										<a href="<?php echo site_url('Report/emp_add_salary') ?>">
											<button class="btn btn-danger" type="button"><i class="fa fa-rotate"></i></button>
										</a>
										<!-- <button class="btn btn-success" type="submit" name="Excel" value="2">Export</button>  -->
									</div>
								</div>
							</div>
						</form>
					<?php } ?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<!-- /.card-header -->
						<div class="card-body">
							<?php if ($logged_user_type == 1 || has_perm($roll_id, 'FNC', 'ASLR', 'Add')) { ?>
								<form id="emp_salary_form" method="post">
									<table id="empsly_tbl" class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Employee</th>
												<th>Salary</th>
												<th>Perday Salary</th>
												<th>Working Days</th>
												<th>Present</th>
												<th>Leave</th>
												<th>Absent</th>
												<th>Payable</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											if (!empty($emp_att)) {
												foreach ($emp_att as $key => $value) {
													$absent_count = ($value->working_days - $value->present_count - $value->leave_count);
													$perday_sal = ($value->m_emp_salary / $value->working_days);
													$payable_amt = (($value->working_days - $absent_count) * $perday_sal);
											?>
													<tr data-changed="false">
														<td><?php echo $i; ?></td>
														<td>
															<?php echo htmlspecialchars($value->m_emp_name); ?>
															<input type="hidden" name="m_salinst_empid[]" value="<?= $value->m_emp_id; ?>">
															<input type="hidden" name="m_salinst_date" value="<?= $from_month; ?>">
														</td>
														<td>
															<input type="number" class="form-control m_salinst_salary" name="m_salinst_salary[]" value="<?= $value->m_emp_salary; ?>" step="0.01" readonly>
														</td>
														<td>
															<input type="number" class="form-control parday_sal" name="parday_salary[]" value="<?= round($perday_sal, 2); ?>" step="0.01" readonly>
														</td>
														<td>
															<input type="number" class="form-control m_salinst_totaldays" name="m_salinst_totaldays[]" value="<?= $value->working_days; ?>" readonly>
														</td>
														<td>
															<input type="number" class="form-control m_salinst_prdays" name="m_salinst_prdays[]" value="<?= $value->present_count; ?>">
														</td>
														<td>
															<input type="number" class="form-control m_salinst_lvdays" name="m_salinst_lvdays[]" value="<?= $value->leave_count; ?>">
														</td>
														<td>
															<input type="number" class="form-control m_salinst_absent" name="m_salinst_absent[]"
																value="<?= $absent_count ?>" readonly>
														</td>
														<td>
															<input type="number" class="form-control m_salinst_payable" name="m_salinst_payable[]" value="<?= round($payable_amt, 2) ?>" step="0.01" readonly>
														</td>
													</tr>
											<?php
													$i++;
												}
											}
											?>
										</tbody>

									</table>
									<button type="submit" class="btn btn-primary" id="submit_salary">Submit</button>
								</form>
							<?PHP } ?>


						</div>
						<!-- /.card-body -->

					</div>

				</div>

			</div>
			<!-- /.row -->

		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->view('footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_salary') ?>
