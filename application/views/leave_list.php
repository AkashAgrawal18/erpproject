<?php $this->view('header') ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-6 text-right">
					<a href="<?php echo site_url('HrDept/leave_add') ?>" class="btn btn-sm btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Leave</a>

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
							<table id="leave_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Name</th>
										<th>Type</th>
										<th>Duration</th> 
										<th>Status</th>
										<th style="width: 15%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('HrDept/leave_add?id=') . $value->m_leav_id;
									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_emp_name; ?></td>
												<td><?php
													if (!empty($value->m_leav_type)) {
														if ($value->m_leav_type == 1) {
															echo "Casual";
														} elseif ($value->m_leav_type == 2) {
															echo "Sick";
														} elseif ($value->m_leav_type == 3) {
															echo "Unleave";
														}  
													}
													?> </td>
												<td>
													<?php
													if (!empty($value->m_leav_duration)) {
														if ($value->m_leav_duration == 1) {
															echo "Full Day";
														} elseif ($value->m_leav_duration == 2) {
															echo "Multiple Days";
														} elseif ($value->m_leav_duration == 3) {
															echo "Half Day";
														}  
													}
													?>
												</td> 
												<td>
													<?php
													if (!empty($value->m_leav_status == 1)) {
													?>
														<a class="btn btn-success btn-sm" title="Active" data-toggle="Active">Active</a>
													<?php
													} else {
													?>
														<a class="btn btn-danger btn-sm" title="In-Active" data-toggle="In-Active">In-Active</a>
													<?php
													}
													?>
												</td>
												<td title="Action" style="white-space: nowrap;">
													<a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<button class="btn btn-danger btn-sm delete-leave" data-value="<?php echo $value->m_leav_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
				<!-- /.col -->

			</div>
			<!-- /.row -->

		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->view('footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_hr') ?>
