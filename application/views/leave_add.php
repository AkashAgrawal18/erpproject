<?php $this->view('header') ?>


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
					<a href="<?php echo site_url('HrDept/leave_list') ?>" class="btn btn-sm btn-info">Leaves List </a>
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
							<form method="post" action="#" id="frm-add-leave">
								<?php if (!empty($edit_value)) {
									$id = $edit_value->m_leav_id;
									$empname = $edit_value->m_leav_empname;
									$type = $edit_value->m_leav_type;
									$duration = $edit_value->m_leav_duration;
									$date = $edit_value->m_leav_date;
									$absence = $edit_value->m_leav_absence;
									$imgfile = $edit_value->m_leav_imgfile;
									$status = $edit_value->m_leav_status;
								} else {
									$id = '';
									$empname = '';
									$type = '';
									$duration = '';
									$date = '';
									$absence = '';
									$imgfile = '';
									$status = '';
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
												<option value="1" <?php if ($type == 1) echo 'selected' ?>>casual</option>
												<option value="2" <?php if ($type == 2) echo 'selected' ?>>Sick</option>
												<option value="3" <?php if ($type == 3) echo 'selected' ?>>Unleave</option>
											</select> 
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Duration </label>
											<div class="d-flex">
												<input type="radio" class="m-2" name="m_leav_duration" value="1" <?php if ($duration == 1) echo 'checked'; ?>> Full Day<br>
												<input type="radio"  class="m-2" name="m_leav_duration" value="2" <?php if ($duration == 2) echo 'checked'; ?>> Multiple Day<br>
												<input type="radio"  class="m-2" name="m_leav_duration" value="3" <?php if ($duration == 3) echo 'checked'; ?>> First Half<br>
												<input type="radio"  class="m-2" name="m_leav_duration" value="4" <?php if ($duration == 4) echo 'checked'; ?>> Second Half
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Date <span class="text-danger">*</span></label>
											<input type="date" name="m_leav_date" id="m_leav_date" class="form-control" required
												value="<?= !empty($date) ? $date : date('Y-m-d') ?>">
										</div>
									</div>

									<div class="col-sm-3">
										<div class="form-group">
											<label>Status</label>
											<select name="m_leav_status" id="m_leav_status" class="form-control" title="Select Status">
												<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
												<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
											</select>
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


<?php $this->view('footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_hr') ?>
