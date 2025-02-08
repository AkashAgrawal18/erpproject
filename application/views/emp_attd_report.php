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
					<form method="post" action="<?php echo site_url('Report/emp_attd_report') ?>">
						<div class="row">
							<div class="col-sm-6">
								<label class="form-check-label">Month</label>
								<input type="month" name="from_month" value="<?php echo isset($from_month) ? date('Y-m', strtotime('01-' . $from_month)) : date('Y-m'); ?>">
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
									<a href="<?php echo site_url('Report/emp_attd_report') ?>">
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
							<table id="dept_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Employee</th>
										<th>Month</th>
										<th>Total Days</th>
										<th>Present</th>
										<th>Absent</th>
										<th>Leave</th>
										<th>Payable Days</th>
										<th style="width: 15%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($emp_att)) {
										foreach ($emp_att as $value) {

									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_emp_name; ?></td>
												<td><?= date('M-Y', strtotime($value->m_date)); ?></td>
												<td>
													<?php
													$month = date('m', strtotime($value->m_date));
													$year = date('Y', strtotime($value->m_date));
													$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
													echo $total_days;
													?>
												</td>
												<td><?php echo $value->present_count; ?></td>
												<td><?php echo $value->absent_count; ?></td>
												<td> <?php echo $value->leave_count; ?></td>
												<td> </td>
												<td class="wd-30">

													<a href="<?php echo base_url('Report/emp_att_detail?id=') . $value->m_emp_id; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
												</td>
											</tr>
									<?php
											$i++;
										}
									}
									?>

								</tbody>
							</table>
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
