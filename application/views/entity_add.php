<?php $this->view('header') ?>
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
					<a href="<?php echo site_url('Billing/entity_list') ?>" class="btn btn-sm btn-info">Entity List </a>
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
				<?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT', 'PDT', 'Add')) { ?>

							<form method="post" action="#" id="frm-add-entity">
								<?php if (!empty($edit_value)) {
									$id = $edit_value->m_entity_id;
									$entityname = $edit_value->m_entity_name;
									$entitytype = $edit_value->m_entity_type ;								
									$mobile = $edit_value->m_entity_mobile;
									$address = $edit_value->m_entity_address; 
									$status = $edit_value->m_entity_status;
								} else {
									$id = '';
									$entityname = '';
									$entitytype = '';
									$mobile = '';
									$address = ''; 
 									$status = '';
								} ?>

								<div class="row">
									<input type="hidden" name="m_entity_id" id="m_entity_id" value="<?= $id ?>">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Entity Name<span class="text-danger">*</span></label>
											<input type="text" name="m_entity_name" placeholder="Entity Name" value="<?= $entityname ?>" required class="form-control"> 
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Entity Type  <span class="text-danger">*</span></label> 
											<select name="m_entity_type" id="m_entity_type" class="form-control select2" required>
												<?php if (!empty($emp_value)) {
													foreach ($emp_value as $key) {
														if ($entitytype == $key->m_emp_id) {
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
											<label>Mobile <span class="text-danger">*</span></label> 
											<input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_entity_mobile" id="m_entity_mobile" class="form-control mobilevali" placeholder="Enter Mobile Number" required="" value="<?= $mobile; ?>">
										</div>
									</div>  
									<div class="col-sm-3">
										<div class="form-group">
											<label>Status</label>
											<select name="m_entity_status" id="m_entity_status" class="form-control" title="Select Status">
												<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
												<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
											</select>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label>Address  </label> 
											<textarea  class="form-control" name="m_entity_address" style="height: 200px;" id="m_entity_address"><?= $address ?></textarea>
										</div>
									</div>
                                
								
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-layout-submit">
											<button type="submit" id="btn-add-entity" class="btn btn-block btn-info">Submit</button>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-layout-submit">
											<a href="<?php echo site_url('Billing/entity_add') ?>" class="btn btn-block btn-danger">Cancel </a>

										</div>
									</div>
								</div>
							</form>
							<?php }?>
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
<?php $this->view('js/js_billing') ?>
 