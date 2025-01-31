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
				<div class="col-sm-10">
					<h1><?= $pagename ?></h1>
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
									$i = 1;
									if (!empty($emp_att_del)) {
										foreach ($emp_att_del as $value) {

									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?= date('d-m-Y', strtotime($value->m_date)); ?></td>
												<td><?php echo $value->m_time_in; ?></td>
												<td><?php echo $value->m_time_out; ?></td>
												<td><?php echo $value->m_status; ?></td>
												<td><?php echo $value->m_remark; ?></td>
												<td> </td>
												<td> </td>
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
