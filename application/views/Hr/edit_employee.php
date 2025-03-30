<?php $this->view('Includes/header'); ?>
<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type'); ?>
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

						<!-- /.card-header -->
						<?php if (!empty($edit_value)) {
							$id               = $edit_value->m_emp_id;
							$code                 = $edit_value->m_emp_code;
							$name               = $edit_value->m_emp_name;
							$fhname               = $edit_value->m_emp_fhname;
							$doj          = $edit_value->m_emp_doj;
							$dob          = $edit_value->m_emp_dob;
							$mobile           = $edit_value->m_emp_mobile;
							$store              = $edit_value->m_emp_store;
							$roll              = $edit_value->m_emp_roll;
							$dept              = $edit_value->m_emp_dept;
							$design              = $edit_value->m_emp_design;
							$altmobile              = $edit_value->m_emp_altmobile;
							$email              = $edit_value->m_emp_email;
							$altemail              = $edit_value->m_emp_altemail;
							$dshift              = $edit_value->m_emp_dshift;
							$dtype              = $edit_value->m_emp_dtype;
							$rest              = $edit_value->m_emp_rest;
							$salary        = $edit_value->m_emp_salary;
							$grosssalary        = $edit_value->m_emp_gross;
							$epfno            = $edit_value->m_emp_epfno;
							$esicno          = $edit_value->m_emp_esicno;
							$accno           = $edit_value->m_emp_accno;
							$panno            = $edit_value->m_emp_panno;
							$epf_applicable            = $edit_value->is_epf_applicable;
							$uanno            = $edit_value->m_emp_uanno;
							$esic_applicable            = $edit_value->is_esic_applicable;
							$bankname            = $edit_value->m_emp_bankname;
							$bankbranch            = $edit_value->m_emp_bankbranch;
							$tds_applicable            = $edit_value->is_tds_applicable;
							$adharno            = $edit_value->m_emp_adharno;
							$ifsc            = $edit_value->m_emp_ifsc;
							$prev_empr            = $edit_value->m_emp_prev_empr;
							$prev_dept            = $edit_value->m_emp_prev_dept;
							$prev_design            = $edit_value->m_emp_prev_design;
							$prev_duration            = $edit_value->m_emp_prev_duration;
							$laddress            = $edit_value->m_emp_laddress;
							$paddress            = $edit_value->m_emp_paddress;
							$password            = $edit_value->m_emp_password;
							$qualification            = $edit_value->m_emp_qualification;
							$dol            = $edit_value->m_emp_dol;
							$login_type            = $edit_value->m_emp_login_type;
							$salmode            = $edit_value->m_emp_salmode;
							$m_emp_status  =  $edit_value->m_emp_status;
							$monthly    = $edit_value->m_emp_monthly;
							$yearly    = $edit_value->m_emp_yearly;
						} else {
							$id = '';
							$code = '';
							$name = '';
							$fhname = '';
							$doj = '';
							$dob = '';
							$mobile = '';
							$store = '';
							$roll = '';
							$dept = '';
							$design = '';
							$altmobile = '';
							$email = '';
							$altemail = '';
							$dshift = '';
							$dtype = '';
							$rest = '';
							$salary = '';
							$grosssalary = '';
							$epfno = '';
							$esicno = '';
							$panno = '';
							$accno = '';
							$epf_applicable = '';
							$uanno = '';
							$esic_applicable = '';
							$bankname = '';
							$bankbranch = '';
							$tds_applicable = '';
							$adharno = '';
							$ifsc = '';
							$prev_empr = '';
							$prev_dept = '';
							$prev_design = '';
							$prev_duration = '';
							$laddress = '';
							$paddress = '';
							$password = '';
							$qualification = '';
							$dol = '';
							$login_type = '';
							$salmode = '';
							$m_emp_status = '';
							$monthly = '';
							$yearly = '';
						}
						?>
						<div class="card-body">
						<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'EMP', 'Edit')) { ?>
							<form method="post" action="#" id="frm-emp-update" enctype="mutipart/form-data">
								<div class="row">
									<input type="hidden" name="m_emp_id" id="m_emp_id" class="form-control" value="<?= $id ?>">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												<div class="form-group">
													<label>Employee Code</label>
													<input type="text" name="m_emp_code" id="m_emp_code" class="form-control" value="<?= $code; ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Employee Name <span class="text-danger">*</span></label>
													<input type="text" name="m_emp_name" id="m_emp_name" class="form-control" required="" value="<?= $name; ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Father Name <span class="text-danger">*</span></label>
													<input type="text" name="m_emp_fhname" id="m_emp_fhname" class="form-control" required='' value="<?= $fhname ?>">
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
																if ($store == $key->m_str_id) {
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
																if ($roll == $key->m_dept_id) {
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
													<input type="date" name="m_emp_dob" id="m_emp_dob" max="<?= date('Y-m-d', strtotime(date('Y-m-d') . '- 15 years')) ?>" class="form-control" required value="<?= $dob ?>">
												</div>
											</div>

											<div class="col-md-2">
												<div class="form-group">
													<label>Date Of Joining <span class="text-danger">*</span></label>
													<input type="date" name="m_emp_doj" id="m_emp_doj" max="<?= date('Y-m-d') ?>" class="form-control" required value="<?= $doj ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Mobile Number <span class="text-danger">*</span></label>
													<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_emp_mobile" id="m_emp_mobile" class="form-control mobilevali" placeholder="Enter Mobile Number" required="" value="<?= $mobile; ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Alt Mobile <span class="text-danger">*</span></label>
													<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_emp_altmobile" id="m_emp_altmobile" class="form-control mobilevali" placeholder="Enter Phone Number" required value="<?= $altmobile; ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Email id</label>
													<input type="email" name="m_emp_email" id="m_emp_email" class="form-control" placeholder="Enter Your Email id" value="<?= $email; ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Alt Email id</label>
													<input type="email" name="m_emp_altemail" id="m_emp_altemail" class="form-control" placeholder="Enter Your Email id" value="<?= $altemail; ?>">
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
														<option value="Fix (Office time)" <?php if ($dtype == "Fix (Office time)") {
																								echo 'selected';
																							} ?>>Fix (Office time)</option>
														<option value="GST-12%" <?php if ($dtype == "GST-12%") {
																					echo 'selected';
																				} ?>>GST-12%</option>

													</select>

												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Rest Day</label>
													<select name="m_emp_rest" id="m_emp_rest" class="form-control select2">
														<option value="none" <?php if ($rest == "none") {
																					echo 'selected';
																				} ?>>None</option>
														<option value="1" <?php if ($rest == "2") {
																				echo 'selected';
																			} ?>>Mon</option>
														<option value="2" <?php if ($rest == "2") {
																				echo 'selected';
																			} ?>>Tue</option>
														<option value="3" <?php if ($rest == "3") {
																				echo 'selected';
																			} ?>>Wed</option>
														<option value="4" <?php if ($rest == "4") {
																				echo 'selected';
																			} ?>>Thu</option>
														<option value="5" <?php if ($rest == "5") {
																				echo 'selected';
																			} ?>>Fri</option>
														<option value="6" <?php if ($rest == "6") {
																				echo 'selected';
																			} ?>>Sat</option>
														<option value="7" <?php if ($rest == "7") {
																				echo 'selected';
																			} ?>>Sun</option>


													</select>

												</div>
											</div>

											<!-- <div class="col-md-4" id="dol_block">
												<div class="form-group">
													<label>Date of Leave</label>
													<input type="date" name="m_emp_dol" id="m_emp_dol" class="form-control" value="<?= $dol ?>">
												</div>
											</div> -->
											<div class="col-md-2" id="">
												<div class="form-group">
													<label>Status</label>
													<select name="m_emp_status" class="form-control">
														<option value="1" <?= $m_emp_status == '1' ? 'selected' : '' ?>>Active</option>
														<option value="2" <?= $m_emp_status == '2' ? 'selected' : '' ?>>IN-Active</option>
													</select>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Password</label>
													<input type="text" name="m_emp_password" id="m_emp_password" class="form-control" value="<?= $password ?>">
												</div>

											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Login Type</label>
													<select name="m_emp_login_type" id="m_emp_login_type" class="form-control">
														<option value="1" <?= $login_type == '1' ? 'selected' : '' ?>>Admin</option>
														<option value="2" <?= $login_type == '2' ? 'selected' : '' ?>>User</option>
													</select>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>No.Of Leaves Monthly</label>
													<input type="number" name="m_emp_monthly" id="m_emp_monthly" class="form-control"  value="<?= $monthly ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>No.Of Leaves yearly</label> 
													<input type="number" name="m_emp_yearly" id="m_emp_yearly" class="form-control"  value="<?= $yearly ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Actual Salary</label>
													<input type="number" name="m_emp_salary" id="m_emp_salary" readonly class="form-control" value="<?= $salary ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Gross Salary</label>
													<input type="number" name="m_emp_gross" id="m_emp_gross" readonly class="form-control" value="<?= $grosssalary ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Previous Employer</label>
													<input type="text" name="m_emp_prev_empr" id="m_emp_prev_empr" class="form-control" value="<?= $prev_empr ?>">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Previous Department</label>
													<input type="text" name="m_emp_prev_dept" id="m_emp_prev_dept" class="form-control" value="<?= $prev_dept ?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Previous Designation</label>
													<input type="text" name="m_emp_prev_design" id="m_emp_prev_design" class="form-control" value="<?= $prev_design ?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Prev. Employement Duration</label>
													<input type="text" name="m_emp_prev_duration" id="m_emp_prev_duration" class="form-control" value="<?= $prev_duration ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Local Address</label>
													<textarea name="m_emp_laddress" id="m_emp_laddress" class="form-control"><?= $laddress ?></textarea>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Permanent Address</label>
													<textarea name="m_emp_paddress" id="m_emp_paddress" class="form-control"><?= $paddress ?></textarea>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Qualification</label>
													<textarea name="m_emp_qualification" id="m_emp_qualification" class="form-control"><?= $qualification ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!---------------5th row completed--------------->
								<h3>Salary Mode</h3>
								<?php
								if (!empty($slbk_value)) {
									$firstRow = true;
									foreach ($slbk_value as $val) { ?>
										<div class="row sbk_delt" id="row">
											<div class="col-md-2">
												<div class="form-group">
													<?php if ($firstRow) { ?> <label>Name</label> <?php } ?>
													<input type="hidden" name="m_esalary_id[]" value="<?= $val->m_esalary_id ?>">
													<input type="hidden" name="m_empid[]" value="<?= $val->m_empid ?>">
													<select name="m_sbreakup_id[]" class="form-control">
														<?php
														if (!empty($salarybk_value)) {
															foreach ($salarybk_value as $row) {
																$areaselect = ($val->m_sbreakup_id == $row->m_dept_id) ? 'selected' : '';
																echo "<option value='" . $row->m_dept_id . "' $areaselect>" . $row->m_dept_name . "</option>";
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<?php if ($firstRow) { ?> <label>Type</label> <?php } ?>
													<select name="m_amounttype[]" class="form-control amountType">
														<option value="1" <?= $val->m_amounttype == '1' ? 'selected' : '' ?>>Add On</option>
														<option value="2" <?= $val->m_amounttype == '2' ? 'selected' : '' ?>>Deduction</option>
													</select>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<?php if ($firstRow) { ?> <label>Amount *</label> <?php } ?>
													<input type="text" name="m_amount[]" class="form-control amount" value="<?= $val->m_amount ?>">
												</div>
											</div>

											<div class="col-md-1 d-flex align-items-end">
												<div class="form-group">
													<button type="button" name="addRowButton" id="addRowButton" class="btn btn-success add_more me-2" title="Add More">+</button>
													<button type="button" class="btn btn-danger removeRowButton delete-sbk" data-value="<?php echo $val->m_esalary_id; ?>">-</button>
												</div>
											</div>
										</div>
								<?php
										$firstRow = false;
									}
								}
								?>
								<div id="repeat_div"></div>


								<div class="row">
									<div class="col-md-6">
										<div class="form-layout-submit">
											<button type="submit" id="btn-emp-update" class="btn btn-block btn-info"> Update</button>
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
		var i = $(".sbk_delt").length;

		function updateAddButtonVisibility() {
			$(".add_more").hide();
			$(".sbk_delt:last .add_more").show();
		}

		updateAddButtonVisibility();

		$(document).on('click', '.add_more', function() {
			i++;

			var newRow = `<div class="row sbk_delt" id="row${i}">
            <div class="col-md-2">
                <div class="form-group">
                    <select name="m_sbreakup_id[]" class="form-control">
                        <?php
						if (!empty($salarybk_value)) {
							foreach ($salarybk_value as $row) {
								echo "<option value='" . $row->m_dept_id . "'>" . $row->m_dept_name . "</option>";
							}
						}
						?>
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
                    <input type="text" name="m_amount[]" class="form-control amount">
                </div>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <div class="form-group">
                    <button type="button" class="btn btn-success add_more me-2" title="Add More">+</button>
                    <button type="button" class="btn btn-danger removeRowButton delete-sbk" data-id="${i}" title="Remove">-</button>
                </div>
            </div>
        </div>`;

			$("#repeat_div").append(newRow);
			updateAddButtonVisibility();
			calculateSalary();
		});

		$(document).on('click', '.removeRowButton', function() {
			$(this).closest('.sbk_delt').remove();
			updateAddButtonVisibility();
			calculateSalary();
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

			$('.row.sbk_delt').each(function() {
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
