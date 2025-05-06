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
					<?php if ($logged_user_type == 1 || has_perm($roll_id, 'LDS', 'LDS', 'List')) { ?>
						<a href="<?php echo site_url('Leads/lead_list') ?>" class="btn btn-sm btn-info">Lead List </a>
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
							<?php if ($logged_user_type == 1 || has_perm($roll_id, 'LDS', 'LDS', 'Add')) { ?>

								<form method="post" action="#" id="frm-add-lead">
									<?php if (!empty($edit_value)) {
										$id = $edit_value->m_lead_id;
										$lead_name = $edit_value->m_lead_name;
										$lead_contname = $edit_value->m_lead_contname;
                                        $lead_type = $edit_value->m_lead_type;
                                        $lead_mobile = $edit_value->m_lead_mobile;
                                        $lead_source = $edit_value->m_lead_source;
                                        $lead_city = $edit_value->m_lead_city;
                                        $lead_state = $edit_value->m_lead_state;
                                        $lead_area = $edit_value->m_lead_area;
                                        $lead_subarea = $edit_value->m_lead_subarea;
                                        $lead_address = $edit_value->m_lead_address;
                                        $lead_assigned = $edit_value->m_lead_assigned;
                                        $lead_status = $edit_value->m_lead_status;
									} else {
										$id = '';
										$lead_name = '';
										$lead_contname = '';
                                        $lead_type = '';
                                        $lead_mobile = '';
                                        $lead_source = '';
                                        $lead_city = '';
                                        $lead_state = '';
                                        $lead_area = '';
                                        $lead_subarea = '';
                                        $lead_address = '';
                                        $lead_assigned = '';
                                        $lead_status = 1;
									} ?>

									<div class="row">
										<input type="hidden" name="m_lead_id" id="m_lead_id" value="<?= $id ?>">
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Type <span class="text-danger">*</span></label>
												<select name="m_lead_type" id="m_lead_type" class="form-control select2" required>
                                                <option value="1" <?php if($lead_type == 1) echo 'selected' ?>>Customer</option>
													<option value="2" <?php if($lead_type == 2) echo 'selected' ?>>Dealer</option>
													<option value="3" <?php if($lead_type == 3) echo 'selected' ?>>Retailer</option>
													<option value="4" <?php if($lead_type == 4) echo 'selected' ?>>Supplier</option>
													<option value="5" <?php if($lead_type == 5) echo 'selected' ?>>Wholeseller</option>
												</select>
											</div>
										</div>
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Shop Name<span class="text-danger">*</span></label>
												<input type="text" name="m_lead_name" placeholder="Lead Name" value="<?= $lead_name ?>" required class="form-control">
											</div>
										</div>
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Contact Person Name<span class="text-danger">*</span></label>
												<input type="text" name="m_lead_contname" placeholder="Contact Person Name" value="<?= $lead_contname ?>" required class="form-control">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Mobile <span class="text-danger">*</span></label>
												<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_lead_mobile" id="m_lead_mobile" class="form-control mobilevali" placeholder="Enter Mobile Number" required="" value="<?= $lead_mobile; ?>">
											</div>
										</div>
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Source</label>
												<select name="m_lead_source" id="m_lead_source" class="form-control" title="Select Source">
												<?php
												if (!empty($source_value)) {
													foreach ($source_value as $sorus) {
												?>
														<option value="<?php echo $sorus->m_status_id; ?>" <?php if ($lead_source == $sorus->m_status_id) echo 'selected'; ?>><?php echo $sorus->m_status_name; ?></option>
												<?php
													}
												}
												?>
												</select>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Assigned Caller <span class="text-danger">*</span></label>
												<select name="m_lead_assigned" id="m_lead_assigned" class="form-control select2">
												<option value="">Select Employee</option>
													<?php if (!empty($emp_value)) {
														foreach ($emp_value as $key) {
															if ($lead_assigned == $key->m_emp_id) {
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
												<label>State </label>
												<select name="m_lead_state" id="m_state" class="form-control select2" title="Select State" >
												<option value="">Select State</option>
												<?php
												if (!empty($state_list)) {
													foreach ($state_list as $ste) {
												?>
														<option value="<?php echo $ste->m_state_id; ?>" <?php if ($lead_state == $ste->m_state_id) echo 'selected'; ?>><?php echo $ste->m_state_name; ?></option>
												<?php
													}
												}
												?>
											</select>
											</div>
										</div>
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>City </label>
												<select name="m_lead_city" id="m_city" class="form-control select2" title="Select City" >
												<option value="">Select City</option>
												<?php
												if (!empty($city_list)) {
													foreach ($city_list as $cty) {
												?>
														<option value="<?php echo $cty->m_city_id; ?>" data-state="<?= $cty->m_city_state?>" <?php if ($lead_city == $cty->m_city_id) echo 'selected'; ?>><?php echo $cty->m_city_name; ?></option>
												<?php
													}
												}
												?>
											</select>
											</div>
										</div>
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Area </label>
												<select name="m_lead_area" id="m_area" class="form-control select2" title="Select Area" >
												<option value="">Select Area</option>
												<?php
												if (!empty($area_list)) {
													foreach ($area_list as $are) {
												?>
														<option value="<?php echo $are->m_area_id; ?>" data-state="<?= $are->m_area_state?>" data-city="<?= $are->m_area_city?>" <?php if ($lead_area == $are->m_area_id) echo 'selected'; ?>><?php echo $are->m_area_name; ?></option>
												<?php
													}
												}
												?>
											</select>
											</div>
										</div>
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Sub Area </label>
												<select name="m_lead_subarea" id="m_subarea" class="form-control select2" title="Select Sub Area" >
												<option value="">Select Sub Area</option>
												<?php
												if (!empty($subarea_list)) {
													foreach ($subarea_list as $sare) {
												?>
														<option value="<?php echo $sare->m_area_id; ?>" data-state="<?= $sare->m_area_state?>" data-city="<?= $sare->m_area_city?>" data-area="<?= $sare->m_area_area?>" <?php if ($lead_subarea == $sare->m_area_id) echo 'selected'; ?>><?php echo $sare->m_area_name; ?></option>
												<?php
													}
												}
												?>
											</select>
											</div>
										</div>
                                       
                                        <div class="col-sm-3 <?php if(empty($edit_value)) echo 'd-none' ?>">
											<div class="form-group">
												<label>Status </label>
												<select name="m_lead_status" id="m_status" class="form-control select2" title="Select Status" >
												<option value="">Select Status</option>
												<?php
												if (!empty($status_value)) {
													foreach ($status_value as $stus) {
												?>
														<option value="<?php echo $stus->m_status_id; ?>" <?php if ($lead_status == $stus->m_status_id) echo 'selected'; ?>><?php echo $stus->m_status_name; ?></option>
												<?php
													}
												}
												?>
											</select>
											</div>
										</div>
										
										<div class="col-sm-12">
											<div class="form-group">
												<label>Address </label>
												<textarea class="form-control" name="m_lead_address" id="m_lead_address"><?= $lead_address ?></textarea>
											</div>
										</div>
										
										
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-layout-submit">
												<button type="submit" id="btn-add-lead" class="btn btn-block btn-info">Submit</button>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-layout-submit">
												<a href="<?php echo site_url('Leads/lead_add') ?>" class="btn btn-block btn-danger">Cancel </a>

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
<?php $this->view('Leads/js/js_lead') ?>
