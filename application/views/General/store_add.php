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
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-2 text-right">
					<?php if ($type == 1) {
						echo '<a href="' . site_url('General/store_list') . '" class="btn btn-sm btn-info">Store List </a>';
					} else {
						echo '<a href="' . site_url('General/warehouse_list') . '" class="btn btn-sm btn-info">Warehouse List </a>';
					} ?>
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
							<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'STRFCT', 'Add')) { ?>

								<form method="post" action="#" id="frm-add-store">
									<?php if (!empty($edit_value)) {
										$id = $edit_value->m_str_id;
										$title = $edit_value->m_str_name;
										$code = $edit_value->m_str_code;
										$stropening = $edit_value->m_str_opening_time;
										$strclosing = $edit_value->m_str_closing_time;
										$manager = $edit_value->m_str_manage_name;
										$mobile = $edit_value->m_str_mobile;
										$address = $edit_value->m_str_address;
										$state = $edit_value->m_state;
										$city = $edit_value->m_city;
										$status = $edit_value->m_str_status;
									} else {
										$id = '';
										$title = '';
										$code = '';
										$stropening = '';
										$strclosing = '';
										$manager = '';
										$mobile = '';
										$address = '';
										$state = '';
										$city = '';
										$status = 1;
									} ?>

									<div class="row">
										<input type="hidden" name="m_str_id" id="m_str_id" value="<?= $id ?>">
										<input type="hidden" name="m_str_type" id="m_str_type" value="<?= $type ?>">
										<div class="col-sm-3">
											<div class="form-group">
												<label>Name<span class="text-danger">*</span></label>
												<input type="text" name="m_str_name" id="m_str_name" class="form-control" placeholder="Enter Store Name" required="" value="<?= $title ?>">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Code </label>
												<input type="text" name="m_str_code" id="m_str_code" class="form-control" placeholder="Enter Code" value="<?= $code ?>">
											</div>
										</div>
										<?php if($type == 1){ ?>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Opening Time<span class="text-danger">*</span></label>
												<input type="time" name="m_str_opening_time" id="m_str_opening_time" class="form-control"" required="" value=" <?= $stropening ?>">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Closing Time<span class="text-danger">*</span></label>
												<input type="time" name="m_str_closing_time" id="m_str_closing_time" class="form-control" required="" value="<?= $strclosing ?>">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Manager Name<span class="text-danger">*</span> </label>
												<input type="text" name="m_str_manage_name" id="m_str_manage_name" required class="form-control" placeholder="Manager Name" value="<?= $manager ?>">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Mobile<span class="text-danger">*</span> </label>
												<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_str_mobile" id="m_str_mobile" class="form-control mobilevali" placeholder="Enter Phone Number" required value="<?= $mobile ?>">
											</div>
										</div>
										 <?php }?>
										<div class="col-sm-3">
											<div class="form-group">
												<label>State<span class="text-danger">*</span></label>
												<select name="m_state" id="m_state" class="form-control select2" required>
													<?php
													foreach ($get_active_state as $skey) {
														if ($state == $skey->m_state_id) {
															$op = 'selected';
														} else {
															$op = '';
														}
													?>
														<option value="<?php echo $skey->m_state_id; ?>" <?= $op ?>><?php echo $skey->m_state_name; ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>City<span class="text-danger">*</span></label>
												<select name="m_city" id="m_city" class="form-control select2" required>
													<?php
													foreach ($get_active_city as $skey) {
														if ($city == $skey->m_city_id) {
															$op = 'selected';
														} else {
															$op = '';
														}
													?>
														<option value="<?php echo $skey->m_city_id; ?>" <?= $op ?>><?php echo $skey->m_city_name; ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Status</label>
												<select name="m_str_status" id="m_str_status" class="form-control" title="Select Status">
													<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
													<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Address</label>
												<textarea class="form-control" name="m_str_address" id="m_str_address"><?= $address ?></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-layout-submit">
												<button type="submit" id="btn-add-store" class="btn btn-block btn-info">Submit</button>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-layout-submit">
												<a href="<?php echo site_url('General/store_add?type='.$type) ?>" class="btn btn-block btn-danger">Cancel </a>

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
<?php $this->view('js/js_master') ?>