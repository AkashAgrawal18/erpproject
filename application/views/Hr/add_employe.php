<?php $this->view('Includes/header'); ?>
<?php $roll_id = $this->session->userdata('roll_id');
$user_type = $this->session->userdata('user_type'); ?>
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
						<?php if ($user_type == 1 || has_perm($roll_id, 'HR', 'EMP', 'List')) { ?>
							<a href="<?= site_url('HrDept/employe_list'); ?>" class="btn btn-info btn-vsm">
								<i class="fa fa-list-alt"></i> All Employees
							</a>
						<?php } ?>
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
							<?php if ($user_type == 1 || has_perm($roll_id, 'HR', 'EMP', 'Add')) { ?>
								<form method="post" action="#" id="frm-emp-create" enctype="mutipart/form-data">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label>Employee Code</label>
														<input type="text" name="m_emp_code" id="m_emp_code" class="form-control">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Employee Name <span class="text-danger">*</span></label>
														<input type="text" name="m_emp_name" id="m_emp_name" class="form-control" required="">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Father Name <span class="text-danger">*</span></label>
														<input type="text" name="m_emp_fhname" id="m_emp_fhname" class="form-control" required=''>
													</div>
												</div>

												<div class="col-md-2">
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

												<div class="col-md-2">
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

												<div class="col-md-2">
													<div class="form-group">
														<label>Store</label>
														<select name="m_emp_store" id="m_emp_store" class="form-control select2">
															<?php if (!empty($store_list)) {
																foreach ($store_list as $key) {
																	if ($company == $key->m_str_id) {
																		$op = 'selected';
																	} else {
																		$op = '';
																	}
																	echo '<option value="' . $key->m_str_id . '" ' . $op . '>' . $key->m_str_name . '</option>';
																}
															} ?>

														</select>

													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Roles</label>
														<select name="m_emp_roll" id="m_emp_roll" class="form-control select2">
															<?php if (!empty($roll_value)) {
																foreach ($roll_value as $key) {
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

												<div class="col-md-2">
													<div class="form-group">
														<label>Date Of Birth <span class="text-danger">*</span></label>
														<input type="date" name="m_emp_dob" id="m_emp_dob" max="<?= date('Y-m-d', strtotime(date('Y-m-d') . '- 15 years')) ?>" class="form-control" required>
													</div>
												</div>

												<div class="col-md-2">
													<div class="form-group">
														<label>Date Of Joining <span class="text-danger">*</span></label>
														<input type="date" name="m_emp_doj" id="m_emp_doj" max="<?= date('Y-m-d') ?>" class="form-control" required>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Mobile Number <span class="text-danger">*</span></label>
														<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_emp_mobile" id="m_emp_mobile" class="form-control mobilevali" placeholder="Enter Mobile Number" required="">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Alt Mobile <span class="text-danger">*</span></label>
														<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_emp_altmobile" id="m_emp_altmobile" class="form-control mobilevali" placeholder="Enter Phone Number" required>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Email id</label>
														<input type="email" name="m_emp_email" id="m_emp_email" class="form-control" placeholder="Enter Your Email id">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Alt Email id</label>
														<input type="email" name="m_emp_altemail" id="m_emp_altemail" class="form-control" placeholder="Enter Your Email id">
													</div>
												</div>

												<div class="col-md-2">
													<div class="form-group">
														<label>Duty Shift</label>
														<select name="m_emp_dshift" id="m_emp_dshift" class="form-control select2" required>
															<?php
															foreach ($shift_value as $skey) {
																if ($m_emp_dshift == $skey->m_dept_id) {
																	$op = 'selected';
																} else {
																	$op = '';
																}
															?>
																<option value="<?php echo $skey->m_dept_id; ?>" <?= $op ?>><?php echo $skey->m_dept_name; ?></option>
															<?php
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Duty Type</label>
														<select name="m_emp_dtype" id="m_emp_dtype" class="form-control select2">
															<option value="Fix (Office time)">Fix (Office time)</option>
															<option value="GST-12%<">GST-12%<< /option>

														</select>

													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Rest Day</label>
														<select name="m_emp_rest" id="m_emp_rest" class="form-control select2">
															<option value="none">None</option>
															<option value="1">Mon</option>
															<option value="2">Tue</option>
															<option value="3">Wed</option>
															<option value="4">Thu</option>
															<option value="5">Fri</option>
															<option value="6">Sat</option>
															<option value="7">Sun</option>
														</select>

													</div>
												</div>
												<div class="col-md-2" id="">
													<div class="form-group">
														<label>Status</label>
														<select name="m_emp_status" id="m_emp_status" class="form-control select2">
															<option value="1">Active</option>
															<option value="2">In-Active</option>
														</select>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Password</label>
														<input type="text" name="m_emp_password" id="m_emp_password" class="form-control">
													</div>

												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>No.Of Leaves Monthly</label>
														<input type="number" name="m_emp_monthly" id="m_emp_monthly" class="form-control">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>No.Of Leaves yearly</label>
														<input type="number" name="m_emp_yearly" id="m_emp_yearly" class="form-control">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Actual Salary</label>
														<input type="text" name="m_emp_salary" id="m_emp_salary" readonly class="form-control">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Gross Salary</label>
														<input type="text" name="m_emp_gross" id="m_emp_gross" readonly class="form-control">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Previous Employer</label>
														<input type="text" name="m_emp_prev_empr" id="m_emp_prev_empr" class="form-control">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Previous Department</label>
														<input type="text" name="m_emp_prev_dept" id="m_emp_prev_dept" class="form-control">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Previous Designation</label>
														<input type="text" name="m_emp_prev_design" id="m_emp_prev_design" class="form-control">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Prev. Employement Duration</label>
														<input type="text" name="m_emp_prev_duration" id="m_emp_prev_duration" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Local Address</label>
														<textarea name="m_emp_laddress" id="m_emp_laddress" class="form-control"> </textarea>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Permanent Address</label>
														<textarea name="m_emp_paddress" id="m_emp_paddress" class="form-control"> </textarea>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Qualification</label>
														<textarea name="m_emp_qualification" id="m_emp_qualification" class="form-control"> </textarea>
													</div>
												</div>
											</div>
										</div>

									</div>
									<!---------------5th row completed--------------->

									<h3>Salary Mode</h3>
									<div class="row mb-3" id="row">
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
														<option value="<?php echo $dkey->m_dept_id; ?>" <?= $op ?>><?php echo $dkey->m_dept_name; ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Type</label>
												<select name="m_amounttype[]" id="m_amounttype" class="form-control amountType">
													<option value="1">Add On</option>
													<option value="2">Deduction</option>
												</select>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Amount *</label>
												<input type="number" name="m_amount[]" class="form-control amount" value="0">
											</div>
										</div>
										<div class="col-md-2 mt-4">
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
							<?php } ?>
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




<?php $this->view('Includes/footer')  ?>
<?php $this->view('js/js_hr') ?>
<?php $this->view('js/js_custom') ?>

<script>
	$(document).ready(function() {
		var i = 0;

		// Handle Add Row button click
		$('#addRowButton').on('click', function() {
			i++;

			var newRow = `<div class="row mb-3 dynamic-row" id="row${i}">
            <div class="col-md-2">
                <div class="form-group"> 
                    <select name="m_sbreakup_id[]" class="form-control select2 category" required>
                        <?php foreach ($salarybk_value as $dkey) { ?>
                            <option value="<?php echo $dkey->m_dept_id; ?>"><?php echo $dkey->m_dept_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group"> 
                    <select name="m_amounttype[]" class="form-control amountType">
                        <option value="1">Add On</option>
                        <option value="2">Deduction</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group"> 
                    <input type="number" name="m_amount[]" class="form-control amount" value="0">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button type="button" class="btn btn-danger removeRowButton" data-id="${i}" title="Remove">-</button>
                </div>
            </div>
        </div>`;

			$("#repeat_div").append(newRow);
			calculateSalary();
		});

		$(document).on('click', '.removeRowButton', function() {
			calculateSalary();

			$(this).closest('.row').remove();
		});

		$(document).on('input blur', '.amount', function() {
			calculateSalary();
		});

		$(document).on('change', '.amountType', function() {
			calculateSalary();
		});

		calculateSalary();

		function calculateSalary() {
			let grossSalary = 0;
			let totalDeductions = 0;

			$('.row.mb-3').each(function() {
				let amount = parseFloat($(this).find('.amount').val()) || 0;
				let type = $(this).find('.amountType').val();

				if (type == "1" || type == "2") {
					grossSalary += amount;
				}

				if (type == "2") {
					totalDeductions += amount;
				}
			});

			let actualSalary = grossSalary - totalDeductions;

			$('#m_emp_gross').val(grossSalary.toFixed(2));
			$('#m_emp_salary').val(actualSalary.toFixed(2));
		}

	});
</script>