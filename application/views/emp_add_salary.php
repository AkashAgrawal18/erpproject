<?php $this->view('header'); ?>

<?php $logged_user_id = $this->session->userdata('user_design');
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
							<form id="emp_salary_form" method="post">
								<table id="empsly_tbl" class="table table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Employee</th>
											<th>Salary</th>
											<th>Total Days</th>
											<th>Present</th>
											<th>Absent</th>
											<th>Leave</th>
											<th>Payable</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										if (!empty($emp_att)) {
											foreach ($emp_att as $key => $value) {
												// Ensure emp_salary has matching index
												$salaryData = isset($emp_salary[$key]) ? $emp_salary[$key] : null;
										?>
												<tr data-changed="false">
													<td><?php echo $i; ?></td>
													<td>
														<?php echo htmlspecialchars($value->m_emp_name); ?>
														<input type="hidden" name="emp_id[]" value="<?php echo $value->m_emp_id; ?>">
													</td>
													<td>
														<input type="number" class="form-control salary" name="salary[]" value="<?php echo $value->m_emp_salary; ?>" step="0.01">
													</td>
													<td>
														<input type="number" class="form-control total_days" name="total_days[]" value="<?php echo $value->attendance_count; ?>" readonly>
													</td>
													<td>
														<input type="number" class="form-control present" name="present[]" value="<?php echo $salaryData ? $salaryData->m_salinst_prdays : 0; ?>">
													</td>
													<td>
														<input type="number" class="form-control absent" name="absent[]"
															value="<?php echo $salaryData ? $salaryData->m_salinst_absent : 0; ?>" readonly>
													</td>
													<td>
														<input type="number" class="form-control leave" name="leave[]" value="<?php echo $salaryData ? $salaryData->m_salinst_lvdays : 0; ?>">
													</td>
													<td>
														<input type="number" class="form-control payable" name="payable[]" value="<?php echo $salaryData ? $salaryData->m_salinst_payable : 0; ?>" step="0.01" readonly>
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
