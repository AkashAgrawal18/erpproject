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
					<h3><?= $pagename ?></h3>
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
							$salmode            = $edit_value->m_emp_salmode;
							$m_emp_status  =  $edit_value->m_emp_status;
							$monthly    = $edit_value->m_emp_monthly;
							$yearly    = $edit_value->m_emp_yearly;
							$m_emp_reporting    = $edit_value->m_emp_reporting;
						} else {
							$id = '';
							$code = '';
							$name = '';
							$fhname = '';
							$doj = date('Y-m-d');
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
							$salmode = '';
							$m_emp_status = '';
							$monthly = '';
							$yearly = '';
							$m_emp_reporting = '';
						}
						?>
						<div class="card-body">
							<?php if ($user_type == 1 || has_perm($roll_id, 'HR', 'EMP', 'Add')) { ?>
								<form method="post" action="#" id="frm-emp-create" enctype="mutipart/form-data">
									<input type="hidden" name="m_emp_id" id="m_emp_id" class="form-control" value="<?= $id ?>">
									<div class="row">
										<div class="col-md-12">
											<h4>Personal Details</h4>
											<div class="row">
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label>Employee Code</label>
																<input type="text" name="m_emp_code" id="m_emp_code" class="form-control" value="<?= $code; ?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Employee Name <span class="text-danger">*</span></label>
																<input type="text" name="m_emp_name" id="m_emp_name" class="form-control" required="" value="<?= $name; ?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Father Name <span class="text-danger">*</span></label>
																<input type="text" name="m_emp_fhname" id="m_emp_fhname" class="form-control" required='' value="<?= $fhname ?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Mobile Number <span class="text-danger">*</span></label>
																<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_emp_mobile" id="m_emp_mobile" class="form-control mobilevali" placeholder="Enter Mobile Number" required="" value="<?= $mobile; ?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Alt Mobile <span class="text-danger">*</span></label>
																<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_emp_altmobile" id="m_emp_altmobile" class="form-control mobilevali" placeholder="Enter Phone Number" required value="<?= $altmobile; ?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Email id</label>
																<input type="email" name="m_emp_email" id="m_emp_email" class="form-control" placeholder="Enter Your Email id" value="<?= $email; ?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Alt Email id</label>
																<input type="email" name="m_emp_altemail" id="m_emp_altemail" class="form-control" placeholder="Enter Your Email id" value="<?= $altemail; ?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Date Of Birth <span class="text-danger">*</span></label>
																<input type="date" name="m_emp_dob" id="m_emp_dob" max="<?= date('Y-m-d', strtotime(date('Y-m-d') . '- 15 years')) ?>" class="form-control" required value="<?= $dob ?>">
															</div>
														</div>
														<div class="col-md-4" id="">
															<div class="form-group">
																<label>Status</label>
																<select name="m_emp_status" class="form-control">
																	<option value="1" <?= $m_emp_status == '1' ? 'selected' : '' ?>>Active</option>
																	<option value="2" <?= $m_emp_status == '2' ? 'selected' : '' ?>>IN-Active</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label>Local Address</label>
																<textarea name="m_emp_laddress" id="m_emp_laddress" class="form-control"><?= $laddress ?></textarea>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>Permanent Address</label>
																<textarea name="m_emp_paddress" id="m_emp_paddress" class="form-control"><?= $paddress ?></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
											<h4>Previous Employer Details</h4>

											<div class="row">

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
												<div class="col-md-2">
													<div class="form-group">
														<label>Previous Designation</label>
														<input type="text" name="m_emp_prev_design" id="m_emp_prev_design" class="form-control" value="<?= $prev_design ?>">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Experience</label>
														<input type="text" name="m_emp_prev_duration" id="m_emp_prev_duration" class="form-control" value="<?= $prev_duration ?>">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label>Qualification</label>
														<input type="text" name="m_emp_qualification" id="m_emp_qualification" class="form-control" value="<?= $qualification ?>" />
													</div>
												</div>
											</div>
											<h4>Official Details</h4>
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label>Date Of Joining <span class="text-danger">*</span></label>
														<input type="date" name="m_emp_doj" id="m_emp_doj" max="<?= date('Y-m-d') ?>" class="form-control" required value="<?= $doj ?>">
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
														<label>Reporting Manager </label>
														<select name="m_emp_reporting" id="m_emp_reporting" class="form-control select2">
															<?php
															foreach ($emp_value as $ekey) {
																if ($ekey->m_emp_id != $id) {
																	$op = $m_emp_reporting == $ekey->m_emp_id ? 'selected' : '';
															?>
																	<option value="<?php echo $ekey->m_emp_id; ?>" <?= $op ?>><?php echo $ekey->m_emp_name; ?>
																	</option>
															<?php
																}
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
															<option value="Inhouse" <?php if ($dtype == "Inhouse") {
																						echo 'selected';
																					} ?>>Inhouse</option>
															<option value="On-Field" <?php if ($dtype == "On-Field") {
																							echo 'selected';
																						} ?>>On-Field</option>
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

												<div class="col-md-2">
													<div class="form-group">
														<label>No.Of Leaves Monthly</label>
														<input type="number" name="m_emp_monthly" id="m_emp_monthly" class="form-control" value="<?= $monthly ?>">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>No.Of Leaves yearly</label>
														<input type="number" name="m_emp_yearly" id="m_emp_yearly" class="form-control" value="<?= $yearly ?>">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Password</label>
														<input type="text" name="m_emp_password" id="m_emp_password" class="form-control" value="<?= $password ?>">
													</div>

												</div>
											</div>

										</div>

									</div>
									<!---------------5th row completed--------------->

									<h3>Salary Mode</h3>

									<?php
									if (!empty($slbk_value)) {
										foreach ($slbk_value as $cao => $val) { ?>
											<div class="row sbk_delt" id="row<?= $cao ?>">
												<div class="col-md-2">
													<div class="form-group">
														<?php if ($cao == 0) { ?> <label>Name</label> <?php } ?>
														<input type="hidden" name="m_esalary_id[]" value="<?= $val->m_esalary_id ?>">
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
														<?php if ($cao == 0) { ?> <label>Type</label> <?php } ?>
														<select name="m_amounttype[]" class="form-control amountType">
															<option value="1" <?= $val->m_amounttype == '1' ? 'selected' : '' ?>>Add On</option>
															<option value="2" <?= $val->m_amounttype == '2' ? 'selected' : '' ?>>Deduction</option>
														</select>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<?php if ($cao == 0) { ?> <label>Amount *</label> <?php } ?>
														<input type="text" name="m_amount[]" class="form-control amount" value="<?= $val->m_amount ?>">
													</div>
												</div>

												<div class="col-md-1 d-flex align-items-end">
													<div class="form-group">
														<button type="button" class="btn btn-danger removeRowButton delete-sbk" data-value="<?php echo $val->m_esalary_id; ?>">-</button>
													</div>
												</div>
												<?php if ($cao == 0) { ?> <div class="col-md-2">
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
												<?php } ?>
											</div>
										<?php
										} ?>
										<div class="row sbk_delt mb-3" id="row<?= $cao ?>">
											<div class="col-md-2">
												<div class="form-group">
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
													<select name="m_amounttype[]" id="m_amounttype" class="form-control amountType">
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
												<div class="form-group" id="buttondiv<?= $cao ?>">
													<button type="button" name="addRowButton" id="addRowButton" class="btn btn-success add_more" title="Add More">+</button>
												</div>
											</div>

										</div>
										<input type="hidden" id="rowunt" value="<?= $cao ?>">
									<?php } else { ?>
										<div class="row sbk_delt mb-3" id="row">
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
												<div class="form-group" id="buttondiv0">
													<button type="button" name="addRowButton" id="addRowButton" class="btn btn-success add_more" title="Add More">+</button>
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
										</div>
										<input type="hidden" id="rowunt" value="0">
									<?php } ?>

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
		let incount = $('#rowunt').val();
		// Handle Add Row button click
		$(document).on('click', '#addRowButton', function() {
			$(`#buttondiv${incount}`).empty().html(`<button type="button" class="btn btn-danger removeRowButton" data-id="${incount}" title="Remove">-</button>`);
			incount++;
			var newRow = `<div class="row sbk_delt mb-3 dynamic-row" id="row${incount}">
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
                <div class="form-group" id="buttondiv${incount}">
					<button type="button" name="addRowButton" id="addRowButton" class="btn btn-success add_more" title="Add More">+</button>
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