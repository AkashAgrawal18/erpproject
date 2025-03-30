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
					<a href="<?php echo site_url('Product/batch_list') ?>" class="btn btn-sm btn-info">Batch List </a>
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

								<form method="post" action="#" id="frm-add-batch">
									<?php if (!empty($edit_value)) {
										$id = $edit_value->m_batch_id;
										$bnumber = $edit_value->m_batch_number;
										$bproid = $edit_value->m_batch_pro_id;
										$quantity = $edit_value->m_batch_quantity;
										$bdate = $edit_value->m_batch_date;
										$epxdate = $edit_value->m_batch_expiry;
										$bwareid = $edit_value->m_batch_ware_id;
										$status = $edit_value->m_batch_status;
										$mrp = $edit_value->m_batch_mrp;
										$price = $edit_value->m_batch_price;
									} else {
										$id = '';
										$bnumber = '';
										$bproid = '';
										$quantity = '';
										$bdate = date('Y-m-d');
										$epxdate = '';
										$bwareid = '';
										$mrp = '';
										$price = '';
										$status = 1;
									} ?>

									<div class="row">
										<input type="hidden" name="m_batch_id" id="m_batch_id" value="<?= $id ?>">
										<div class="col-sm-3">
											<div class="form-group">
												<label>Date <span class="text-danger">*</span></label>
												<input type="date" name="m_batch_date" value="<?= !empty($bdate) ? $bdate : date('Y-m-d') ?>" required class="form-control">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Batch Number<span class="text-danger">*</span></label>
												<input type="text" name="m_batch_number" placeholder="Batch Number" value="<?= $bnumber ?>" required class="form-control">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Product <span class="text-danger">*</span></label>
												<select name="m_batch_pro_id" id="m_batch_pro_id" class="form-control select2" required>
													<?php if (!empty($pro_value)) {
														foreach ($pro_value as $key) {
															if ($bproid == $key->m_pro_id) {
																$op = 'selected';
															} else {
																$op = '';
															}
															echo '<option value="' . $key->m_pro_id . '" ' . $op . '>' . $key->m_pro_name .' - '.$key->package_name .' - '.$key->size_name . '</option>';
														}
													} ?>

												</select>
											</div>
										</div>

										<div class="col-sm-3">
											<div class="form-group">
												<label>Warehouse <span class="text-danger">*</span></label>
												<select name="m_batch_ware_id" id="m_batch_ware_id" class="form-control select2" required>
													<?php if (!empty($ware_value)) {
														foreach ($ware_value as $row) {
															if ($bwareid == $row->m_str_id) {
																$op = 'selected';
															} else {
																$op = '';
															}
															echo '<option value="' . $row->m_str_id . '" ' . $op . '>' . $row->m_str_name . '</option>';
														}
													} ?>

												</select>
											</div>
										</div>

										<div class="col-sm-3">
											<div class="form-group">
												<label>Quantity <span class="text-danger">*</span></label>
												<input type="number" name="m_batch_quantity" value="<?= $quantity ?>" required class="form-control">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Price <span class="text-danger">*</span></label>
												<input type="number" name="m_batch_price" value="<?= $price ?>" required class="form-control">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>MRP </label>
												<input type="number" name="m_batch_mrp" value="<?= $mrp ?>" class="form-control">
											</div>
										</div>

										<div class="col-sm-3">
											<div class="form-group">
												<label> Expiry Period(In-Month) <span class="text-danger">*</span></label>
												<input type="number" name="m_batch_expiry" value="<?= $epxdate; ?>" required class="form-control">
											</div>
										</div>


										<div class="col-sm-3">
											<div class="form-group">
												<label>Status</label>
												<select name="m_batch_status" id="m_batch_status" class="form-control" title="Select Status">
													<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
													<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
												</select>
											</div>
										</div>



									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-layout-submit">
												<button type="submit" id="btn-add-batch" class="btn btn-block btn-info">Submit</button>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-layout-submit">
												<a href="<?php echo site_url('Product/batch_add') ?>" class="btn btn-block btn-danger">Cancel </a>

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