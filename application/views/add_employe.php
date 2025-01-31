<?php $this->view('header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-6 text-right">
					<div class="seipkon-breadcromb-right">
						<a href="<?= site_url('HrDept/employe_list'); ?>" class="btn btn-info btn-vsm">
							<i class="fa fa-list-alt"></i> All Employees
						</a>
					</div>
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
							<form method="post" action="#" id="frm-emp-create" enctype="mutipart/form-data">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Employee Code</label>
													<input type="text" name="m_emp_code" id="m_emp_code" class="form-control">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Employee Name <span class="text-danger">*</span></label>
													<input type="text" name="m_emp_name" id="m_emp_name" class="form-control" required="">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Father Name <span class="text-danger">*</span></label>
													<input type="text" name="m_emp_fhname" id="m_emp_fhname" class="form-control" required=''>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Department <span class="text-danger">*</span></label>
													<select name="m_emp_dept" id="m_emp_dept" class="form-control select2" required>
														<?php
														foreach ($dept_value as $dkey) {
															if ($dept == $dkey->m_dept_id) {
																$op = 'selected';
															} else {
																$op = '';
															}
														?>
															<option value="<?php echo $dkey->m_dept_id; ?>" <?= $op ?>><?php echo $dkey->m_dept_name; ?>
															</option>
														<?php
														}

														?>

													</select>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Designation <span class="text-danger">*</span></label>
													<select name="m_emp_design" id="m_emp_design" class="form-control select2" required>
														<?php
														foreach ($design_value as $dekey) {
															if ($design == $dekey->m_dept_id) {
																$op = 'selected';
															} else {
																$op = '';
															}
														?>
															<option value="<?php echo $dekey->m_dept_id; ?>" <?= $op ?>><?php echo $dekey->m_dept_name; ?>
															</option>
														<?php
														}

														?>

													</select>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Company</label>
													<select name="m_emp_company" id="m_emp_company" class="form-control select2">
														<?php if (!empty($company_list)) {
															foreach ($company_list as $key) {
																if ($company == $key->m_dept_id) {
																	$op = 'selected';
																} else {
																	$op = '';
																}
																echo '<option value="' . $key->m_dept_id . '" ' . $op . '>' . $key->m_dept_name . '</option>';
															}
														} ?>

													</select>

												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Date Of Birth <span class="text-danger">*</span></label>
													<input type="date" name="m_emp_dob" id="m_emp_dob" max="<?= date('Y-m-d', strtotime(date('Y-m-d') . '- 15 years')) ?>" class="form-control" required>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Date Of Joining <span class="text-danger">*</span></label>
													<input type="date" name="m_emp_doj" id="m_emp_doj" max="<?= date('Y-m-d') ?>" class="form-control" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Mobile Number <span class="text-danger">*</span></label>
													<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_emp_mobile" id="m_emp_mobile" class="form-control mobilevali" placeholder="Enter Mobile Number" required="">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Alt Mobile <span class="text-danger">*</span></label>
													<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_emp_altmobile" id="m_emp_altmobile" class="form-control mobilevali" placeholder="Enter Phone Number" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Email id</label>
													<input type="email" name="m_emp_email" id="m_emp_email" class="form-control" placeholder="Enter Your Email id">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Alt Email id</label>
													<input type="email" name="m_emp_altemail" id="m_emp_altemail" class="form-control" placeholder="Enter Your Email id">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Duty Shift</label>
													<select name="m_emp_dshift" id="m_emp_dshift" class="form-control select2">
														<option value="General">General</option>
														<option value="GST-12%">GST-12%</option>
													</select>

												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Duty Type</label>
													<select name="m_emp_dtype" id="m_emp_dtype" class="form-control select2">
														<option value="Fix (Office time)">Fix (Office time)</option>
														<option value="GST-12%<">GST-12%<< /option>

													</select>

												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Rest Day</label>
													<select name="m_emp_rest" id="m_emp_rest" class="form-control select2">
														<option value="none">None</option>
														<option value="mon">Mon</option>
														<option value="tue">Tue</option>
														<option value="wed">Wed</option>
														<option value="thu">Thu</option>
														<option value="fri">Fri</option>
														<option value="sat">Sat</option>
														<option value="sun">Sun</option>
													</select>

												</div>
											</div>
											<!-- 
											<div class="col-md-4" id="">
												<div class="form-group">
													<label>Date of Leave</label>
													<input type="date" name="m_emp_dol" id="m_emp_dol" class="form-control">
												</div>
											</div> -->
											<div class="col-md-4" id="">
												<div class="form-group">
													<label>Status</label>
													<select name="m_emp_status" id="m_emp_status" class="form-control select2">
														<option value="1">Active</option>
														<option value="2">In-Active</option>
													</select>
												</div>
											</div>

										</div>
									</div>
									<div class="col-md-6">
										<div class="row">

											<div class="col-sm-12 text-center">
												<?php if ($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') != 3 && $this->session->userdata('user_dept') == 1) {
													echo '<a class="nav-top-btn nabtn active" id="Salary">Salary</a>
                                                <a class="nav-top-btn nabtn" id="Statuatory">Statuatory</a>';
												} ?>
												<!-- <a class="btn btn-sm " id="Prev_emp">Previous Emp</a>
                                                <a class="btn btn-sm " id="Address">Address</a>
                                                <a class="btn btn-sm " id="Login_dtl">Login Details</a>
                                                <a class="btn btn-sm " id="Skills">Skills </a> -->
											</div>

											<div class="container-fluid">
												<div class="navlink-container">

													<div class="row Prev_emp">
														<div class="col-md-6">
															<div class="form-group">
																<label>Previous Employer</label>
																<input type="text" name="m_emp_prev_empr" id="m_emp_prev_empr" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Previous Department</label>
																<input type="text" name="m_emp_prev_dept" id="m_emp_prev_dept" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Previous Designation</label>
																<input type="text" name="m_emp_prev_design" id="m_emp_prev_design" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Prev. Employement Duration</label>
																<input type="text" name="m_emp_prev_duration" id="m_emp_prev_duration" class="form-control">
															</div>
														</div>
													</div>

													<div class="row Address">
														<div class="col-md-12">
															<div class="form-group">
																<label>Local Address</label>
																<textarea name="m_emp_laddress" id="m_emp_laddress" class="form-control"> </textarea>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>Permanent Address</label>
																<textarea name="m_emp_paddress" id="m_emp_paddress" class="form-control"> </textarea>
															</div>
														</div>

													</div>

													<div class="row Login_dtl">
														<div class="col-md-6">
															<div class="form-group">
																<label>Password</label>
																<input type="text" name="m_emp_password" id="m_emp_password" class="form-control">
															</div>

														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Login Type</label>
																<select name="m_emp_login_type" id="m_emp_login_type" class="form-control">
																	<option value="1">Security Guard</option>
																	<option value="2">Ticket Counter</option>
																	<option value="3">PRO (leads)</option>
																</select>

															</div>

														</div>
													</div>

													<div class="row Skills">
														<div class="col-md-12">
															<div class="form-group">
																<label>Qualification</label>
																<textarea name="m_emp_qualification" id="m_emp_qualification" class="form-control"> </textarea>
															</div>
														</div>
													</div>
												</div>




											</div>
										</div>
									</div>


								</div>
								<!---------------5th row completed--------------->


								<div class="row mb-3" id="row">
									<div class="col-sm-12">
										<h3>Salary Mode</h3>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>Name</label>
											<select name="m_sbreakup_id[]" id="m_sbreakup_id" class="form-control select2" required>
												<?php
												foreach ($salarybk_value as $dkey) {
													if ($dept == $dkey->m_dept_id) {
														$op = 'selected';
													} else {
														$op = '';
													}
												?>
													<option value="<?php echo $dkey->m_dept_id; ?>" <?= $op ?>><?php echo $dkey->m_dept_name; ?>
													</option>
												<?php
												}

												?>

											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>Type</label>
											<select name="m_amounttype[]" id="m_amounttype" class="form-control">
												<option value="1">Add On</option>
												<option value="2">Deduction</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>Amount *</label>
											<input type="text" name="m_amount[]" class="form-control" id="m_amount">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<button type="button" name="addRowButton" id="addRowButton" class="btn btn-success add_more" title="Add More">+</button>
										</div>
									</div>
								</div>
								<div id="repeat_div"></div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-layout-submit">
											<button type="submit" id="btn-emp-create" class="btn btn-block btn-info"> Submit</button>
										</div>
									</div>
									<div class="col-md-6">
										<?php if (!empty($id)) { ?>
											<div class="form-layout-submit"><a href="<?php echo site_url('HrDept/employe_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
											<?php } else { ?>
												<div class="form-layout-submit"><a href="<?php echo site_url('HrDept/add_employe'); ?>" class="btn btn-block btn-danger">Reset</a>
												<?php } ?>
												</div>
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
<?php $this->view('js/js_hr') ?>


<script>
	$(document).ready(function() {
		var i = 0;

		// Handle Add Row button click
		$('#addRowButton').on('click', function() {
			i++;

			var newRow = `<div class="row mb-3" id="row${i}">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Name</label>
                    <select name="m_sbreakup_id[]" class="form-control select2" required>
                        <?php foreach ($salarybk_value as $dkey) { ?>
                            <option value="<?php echo $dkey->m_dept_id; ?>"><?php echo $dkey->m_dept_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Type</label>
                    <select name="m_amounttype[]" class="form-control">
                        <option value="1">Add On</option>
                        <option value="2">Deduction</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Amount *</label>
                    <input type="text" name="m_amount[]" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button type="button" class="btn btn-danger removeRowButton" data-id="${i}" title="Remove">-</button>
                </div>
            </div>
        </div>`;

			$("#repeat_div").append(newRow);


		});

		// Handle Remove Row button click
		$(document).on('click', '.removeRowButton', function() {
			$(this).closest('.row').remove();
		});
	});
</script>
