<?php $this->view('header'); ?>

<?php $logged_user_id = $this->session->userdata('user_design');
$logged_user_type = $this->session->userdata('user_type');
if ($pgtype == 1) {
	$relink = "department_list";
	$headname = "Department";
} else if ($pgtype == 2) {
	$relink = "designation_list";
	$headname = "Designation";
} else if ($pgtype == 3) {
	$relink = "salaryBreakup_list";
	$headname = "";
} else if ($pgtype == 4) {
	$relink = "shift_roster_list";
	$headname = "Shift Roster";
}
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
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">

						<!-- /.card-header -->
						<div class="card-body">
							<table id="dept_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th><?= $headname ?> Name</th>

										<?php if ($pgtype == 1 || $pgtype == 2) { ?>
											<th><?= $headname ?> Code</th>
										<?php } elseif ($pgtype == 3) { ?>
											<th><?= $headname ?> Type</th>
										<?php } ?>

										<?php if ($pgtype == 4) { ?>
											<th>Start Time</th>
											<th>End Time</th>
										<?php } ?>

										<th>Status</th>
										<th style="width: 15%">Action</th>
									</tr>

								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('HrDept/' . $relink . '?id=') . $value->m_dept_id;
									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_dept_name; ?></td>

												<?php if ($pgtype == 1 || $pgtype == 2) { ?>
													<td><?php echo $value->m_dept_code; ?></td>
												<?php } elseif ($pgtype == 3) { ?>
													<td><?php echo $value->m_dept_type; ?></td>
												<?php } ?>

												<?php if ($pgtype == 4) { ?>
													<td><?php echo $value->m_start_time; ?></td>
													<td><?php echo $value->m_end_time; ?></td>
												<?php } ?>
												<td>
													<?php
													if (!empty($value->m_dept_status == 1)) {
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
													<button class="btn btn-danger btn-sm delete-dept" data-value="<?php echo $value->m_dept_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>

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
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php if (!empty($id)) {
														echo 'Edit Value';
													} else {
														echo 'Add New';
													} ?></h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<form method="post" action="#" id="frm-add-dept">

								<?php if (!empty($edit_value)) {
									$id = $edit_value->m_dept_id;
									$title = $edit_value->m_dept_name;
									$pgtype = $edit_value->m_dept_type;
									$code = $edit_value->m_dept_code;
									$status = $edit_value->m_dept_status;
									$starttime = $edit_value->m_start_time;
									$endtime = $edit_value->m_end_time;
								} else {
									$id = '';
									$title = '';
									$code = '';
									$status = 1;
									$starttime = '';
									$endtime = '';
								} ?>
								<div class="row">
									<div class="col-md-12">
										<?php if ($pgtype == 3) { ?>
											<div class="form-group">
												<label><?= $headname ?> type<span class="text-danger">*</span></label>
												<select name="m_dept_code" id="m_dept_code" class="form-control" required>
													<option value="addon" <?php if ($code == 'addon') echo 'selected'; ?>>Add On</option>
													<option value="deduction" <?php if ($code == 'deduction') echo 'selected'; ?>>Deduction</option>
												</select>
											</div>
										<?php } elseif ($pgtype == 4) { ?>
											<div class="form-group">
												<label> Start Time<span class="text-danger">*</span></label>
												<input type="time" name="m_start_time" id="m_start_time" class="form-control" placeholder="Enter start time" required value="<?= $starttime ?>">
											</div>
											<div class="form-group">
												<label> End Time<span class="text-danger">*</span></label>
												<input type="time" name="m_end_time" id="m_end_time" class="form-control" placeholder="Enter end time" required value="<?= $endtime ?>">
											</div>
										<?php } else { ?>
											<div class="form-group">
												<label><?= $headname ?> Code<span class="text-danger">*</span></label>
												<input type="text" name="m_dept_code" id="m_dept_code" class="form-control" placeholder="Enter code" required value="<?= $code ?>">
											</div>
										<?php } ?>

									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label><?= $headname ?> Name<span class="text-danger">*</span></label>
											<input type="hidden" name="m_dept_id" id="m_dept_id" value="<?= $id ?>">
											<input type="hidden" name="m_dept_type" id="m_dept_type" value="<?= $pgtype ?>">
											<input type="text" name="m_dept_name" id="m_dept_name" class="form-control" placeholder="Enter Name" required="" value="<?= $title ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Status</label>
											<select name="m_dept_status" id="m_dept_status" class="form-control" title="Select Status">
												<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
												<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-layout-submit">
											<button type="submit" id="btn-add-dept" class="btn btn-block btn-info">Submit</button>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-layout-submit">
											<a href="<?php echo site_url('HrDept/' . $relink) ?>" class="btn btn-block btn-danger">Cancel </a>

										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->

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
