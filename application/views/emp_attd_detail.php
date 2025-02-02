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
				<div class="col-sm-4">
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-6">
					<form method="post" action="<?php echo site_url('Report/emp_att_detail?id=') . $id; ?>">
						<div class="row">
							<div class="col-sm-6">
								<label class="form-check-label">Month</label>
								<input type="month" name="from_month" value="<?php echo $from_month; ?>">
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
									<a href="<?php echo site_url('Report/emp_att_detail?id=') . $id; ?>">
										<button class="btn btn-danger" type="button"><i class="fa fa-rotate"></i></button>
									</a>
									<!-- <button class="btn btn-success" type="submit" name="Excel" value="2">Export</button>  -->
								</div>
							</div>
						</div>
					</form>

				</div>
				<div class="col-sm-2 text-right">
					<a href="<?php echo base_url('Report/emp_attd_report'); ?>" class="btn btn-info">
						Back
					</a>

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
										<th>Date</th>
										<th>TimeIn</th>
										<th>TimeOut</th>
										<th>Status</th>
										<th>Remark</th>
										<th>Leave</th>
										<th style="width: 15%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!empty($emp_att_del)) {
										$month = date('m', strtotime($emp_att_del[0]->m_date));  
										$year = date('Y', strtotime($emp_att_del[0]->m_date));  
										$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);  
										$attendance_data = [];
										foreach ($emp_att_del as $value) {
											$attendance_data[date('Y-m-d', strtotime($value->m_date))] = $value;
										}
 
										for ($day = 1; $day <= $total_days; $day++) {
											$current_date = date('Y-m-d', strtotime("$year-$month-$day"));  
									?>
											<tr>
												<td><?php echo $day; ?></td>  
												<td><?= date('d-m-Y', strtotime($current_date)); ?></td>  

												<?php if (isset($attendance_data[$current_date])) {
													$value = $attendance_data[$current_date]; ?>

													<td><?php echo $value->m_time_in; ?></td>
													<td><?php echo $value->m_time_out; ?></td>
													<td><?php echo $value->m_status; ?></td>
													<td><?php echo $value->m_remark; ?></td>

												<?php } else { ?>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
												<?php } ?>

												<td> </td>
												<td> </td>
											</tr>
									<?php
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
