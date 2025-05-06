<?php $this->view('Includes/header') ?>

<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-10">
					<h3><?= $pagename ?></h3>
				</div>
				<div class="col-sm-2 text-right">
					<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'LVS', 'List')) { ?>
						<a href="<?php echo site_url('HrDept/leave_list') ?>" class="btn btn-sm btn-info">Leaves List </a>
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

						<div class="card-body">
							<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'LVS', 'Add')) { ?>

								<form method="post" action="#" id="frm-add-leave">
									<?php if (!empty($edit_value)) {
										$id = $edit_value->m_leav_id;
										$empname = $edit_value->m_leav_empname;
										$type = $edit_value->m_leav_type;
										$duration = $edit_value->m_leav_duration;
										$fromdate = $edit_value->m_leav_fromdate;
										$todate = $edit_value->m_leav_todate;
										$absence = $edit_value->m_leav_absence;
										$imgfile = $edit_value->m_leav_imgfile;
									} else {
										$id = '';
										$empname = '';
										$type = '';
										$duration = '';
										$fromdate = '';
										$todate = '';
										$absence = '';
										$imgfile = '';
									} ?>

									<div class="row">
										<input type="hidden" name="m_leav_id" id="m_leav_id" value="<?= $id ?>">
										<div class="col-sm-3">
											<div class="form-group">
												<label>Employee Name<span class="text-danger">*</span></label>
												<select name="m_leav_empname" id="m_leav_empname" class="form-control select2">
													<?php if (!empty($emp_value)) {
														foreach ($emp_value as $key) {
															if ($empname == $key->m_emp_id) {
																$op = 'selected';
															} else {
																$op = '';
															}
															echo '<option value="' . $key->m_emp_id . '" ' . $op . '>' . $key->m_emp_name . '</option>';
														}
													} ?>

												</select>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Leave Type </label>
												<select name="m_leav_type" id="m_leav_type" class="form-control" title="Select Status">
													<option value="1" <?php if ($type == 1) echo 'selected' ?>>Casual</option>
													<option value="2" <?php if ($type == 2) echo 'selected' ?>>Sick</option>
													<option value="3" <?php if ($type == 3) echo 'selected' ?>>Earn</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Duration</label>
												<div class="d-flex">
													<input type="radio" class="m-2" name="m_leav_duration" value="1" <?php if ($duration == 1) echo 'checked'; ?> onclick="toggleToDate()"> Full Day<br>
													<input type="radio" class="m-2" name="m_leav_duration" value="2" <?php if ($duration == 2) echo 'checked'; ?> onclick="toggleToDate()"> Multiple Day<br>
													<input type="radio" class="m-2" name="m_leav_duration" value="3" <?php if ($duration == 3) echo 'checked'; ?> onclick="toggleToDate()"> Half Days<br>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>From Date <span class="text-danger">*</span></label>
												<input type="date" name="m_leav_fromdate" id="m_leav_fromdate" class="form-control" required
													value="<?= !empty($fromdate) ? $fromdate : date('Y-m-d') ?>">
											</div>
										</div>

										<div class="col-sm-3" id="toDateField" style="display: none;">
											<div class="form-group">
												<label>To Date</label>
												<input type="date" name="m_leav_todate" id="m_leav_todate" class="form-control"
													value="<?= !empty($todate) ? $todate : date('Y-m-d') ?>">
											</div>
										</div>

										<div class="col-sm-12">
											<div class="form-group">
												<label>Reason for Absence<span class="text-danger">*</span> </label>
												<textarea name="m_leav_absence" id="m_leav_absence" class="form-control" placeholder="e.g.Feeling not well" required><?= $absence ?></textarea>
											</div>
										</div>

										<div class="col-sm-12">
											<div class="form-group">
												<?php
												if (!empty($imgfile) && file_exists('uploads/leavefile/' . $imgfile)) {
													$catepic = base_url('uploads/leavefile/' . $imgfile);
												} else {
													$catepic = base_url('uploads/leavefile/default.png');
												}
												?>
												<label class="control-label">Image</label>
												<input type="hidden" name="leaveimg" value="<?php echo $imgfile ?>">
												<input type="file" style="height: 200px;" name="m_leav_imgfile" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-layout-submit">
												<button type="submit" id="btn-add-leave" class="btn btn-block btn-info">Submit</button>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-layout-submit">
												<a href="<?php echo site_url('HrDept/leave_add') ?>" class="btn btn-block btn-danger">Cancel </a>

											</div>
										</div>
									</div>
								</form>
							<?php } ?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->view('Includes/footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_hr') ?>


<script>
	function toggleToDate() {
		var multipleDayRadio = document.querySelector('input[name="m_leav_duration"][value="2"]');
		var toDateField = document.getElementById('toDateField');

		if (multipleDayRadio.checked) {
			toDateField.style.display = 'block';
		} else {
			toDateField.style.display = 'none';
		}
	}

	window.onload = toggleToDate;
</script>