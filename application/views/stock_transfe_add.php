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
					<a href="<?php echo site_url('Billing/stock_transfer_list') ?>" class="btn btn-sm btn-info">Stock Transfer List </a>
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
									$stk_trans_id = $edit_value->stk_trans_id;
									$stk_trans_batch = $edit_value->stk_trans_batch;
									$stk_trans_from = $edit_value->stk_trans_from;								
									$stk_trans_to = $edit_value->stk_trans_to;
									$stk_trans_entity = $edit_value->stk_trans_entity; 
									$stk_trans_qty = $edit_value->stk_trans_qty;
									$stk_trans_date = $edit_value->stk_trans_date;
									$stk_trans_remark = $edit_value->stk_trans_remark;
									$stk_trans_status = $edit_value->stk_trans_status;
								} else {
									$stk_trans_id = '';
									$stk_trans_batch = '';
									$stk_trans_from = '';
									$stk_trans_to = '';
									$stk_trans_entity = ''; 
 									$stk_trans_qty = '';
 									$stk_trans_date = '';
 									$stk_trans_remark = '';
 									$stk_trans_status = '';
								} ?>

								<div class="row">
									<input type="hidden" name="stk_trans_id" id="stk_trans_id" value="<?= $stk_trans_id ?>">
								 
									<div class="col-sm-3">
										<div class="form-group">
											<label>Batch <span class="text-danger">*</span></label> 
											<select name="stk_trans_batch" id="stk_trans_batch" class="form-control select2" required>
												<?php if (!empty($batch_value)) {
													foreach ($batch_value as $key) {
														if ($stk_trans_batch == $key->m_batch_id) {
															$op = 'selected';
														} else {
															$op = '';
														}
														echo '<option value="' . $key->m_batch_id . '" ' . $op . '>' . $key->m_batch_number . '</option>';
													}
												} ?>

											</select>
										</div>
									</div>  
									<div class="col-sm-3">
										<div class="form-group">
											<label>From Date <span class="text-danger">*</span></label> 
											<input type="date"  name="stk_trans_from"   value="<?= !empty($stk_trans_from) ? $stk_trans_from : date('Y-m-d') ?>" required class="form-control"> 										 
										</div>
									</div> 
									<div class="col-sm-3">
										<div class="form-group">
											<label>To Date <span class="text-danger">*</span></label> 
											<input type="date"  name="stk_trans_to"   value="<?= !empty($stk_trans_to) ? $stk_trans_to : date('Y-m-d') ?>" required class="form-control"> 										 
										</div>
									</div> 
									<div class="col-sm-3">
										<div class="form-group">
											<label>Entity <span class="text-danger">*</span></label> 
											<select name="stk_trans_batch" id="stk_trans_batch" class="form-control select2" required>
												<?php if (!empty($entity_value)) {
													foreach ($entity_value as $key) {
														if ($stk_trans_batch == $key->m_entity_id) {
															$op = 'selected';
														} else {
															$op = '';
														}
														echo '<option value="' . $key->m_entity_id . '" ' . $op . '>' . $key->m_entity_name . '</option>';
													}
												} ?>

											</select>
										</div>
									</div>  
									<div class="col-sm-3">
										<div class="form-group">
											<label>Quntity <span class="text-danger">*</span></label> 
											<input type="number" name="stk_trans_qty"   value="<?= $stk_trans_qty ?>" required class="form-control"> 											 
										</div>
									</div> 
									<div class="col-sm-3">
										<div class="form-group">
											<label>Transfer Date <span class="text-danger">*</span></label> 
											<input type="date"  name="stk_trans_date"   value="<?= !empty($stk_trans_date) ? $stk_trans_date : date('Y-m-d') ?>" required class="form-control"> 										 
										</div>
									</div> 
									
									<div class="col-sm-3">
										<div class="form-group">
											<label>Status</label>
											<select name="stk_trans_status" id="stk_trans_status" class="form-control" title="Select Status">
												<option value="1" <?php if ($stk_trans_status == 1) echo 'selected' ?>>Active</option>
												<option value="0" <?php if ($stk_trans_status == 0) echo 'selected' ?>>In-Active</option>
											</select>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label>Remark </label> 
											<textarea name="stk_trans_remark" class="form-control"  id="stk_trans_remark" style="height: 150px;"><?= $stk_trans_remark ?></textarea>
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
 