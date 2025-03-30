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
					<a href="<?php echo site_url('Invoice/stock_transfer_list') ?>" class="btn btn-sm btn-info">Stock Transfer List </a>
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

								<form method="post" action="#" id="frm-add-stocktrans">
									<?php if (!empty($edit_value)) {
										$stk_trans_challan = $edit_value[0]->stk_trans_challan;
										$stk_trans_date = $edit_value[0]->stk_trans_date;
										$stk_trans_from = $edit_value[0]->stk_trans_from;
										$stk_trans_to = $edit_value[0]->stk_trans_to;
										$stk_trans_remark = $edit_value[0]->stk_trans_remark;
									} else {
										$stk_trans_challan = '';
										$stk_trans_date = date('Y-m-d');
										$stk_trans_from = '';
										$stk_trans_to = '';
										$stk_trans_remark = '';
									} ?>

									<div class="row mb-1 g-3">

										<div class="col-md-3">
											<div class="form-group">
												<label>Date <span class="text-danger">*</span></label>
												<input type="date" max="<?= date('Y-m-d') ?>" name="stk_trans_date" id="stk_trans_date" class="form-control" required="" value="<?= $stk_trans_date ?>">
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>Challan No <span class="text-danger">*</span></label>
												<input type="text" name="stk_trans_challan" id="stk_trans_challan" class="form-control" placeholder="Enter Challan No" value="<?= $stk_trans_challan ?>">
											</div>
										</div>

										<div class="col-sm-3">
											<div class="form-group">
												<label>Transfer From <span class="text-danger">*</span></label>
												<select name="stk_trans_from" id="stk_trans_from" class="form-control select2" required>
													<option value="">Select Warehouse</option>
													<?php if (!empty($store_value)) {
														foreach ($store_value as $key) {
															if ($key->m_str_type == 2) {
																$op = $stk_trans_from == $key->m_str_id ? 'selected' : '';
																echo '<option value="' . $key->m_str_id . '" ' . $op . '>' . $key->m_str_name . '</option>';
															}
														}
													} ?>

												</select>

											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Transfer To <span class="text-danger">*</span></label>
												<select name="stk_trans_to" id="stk_trans_to" class="form-control select2" required>
													<option value="">Select Transfer To</option>
													<?php if (!empty($store_value)) {
														foreach ($store_value as $key) {
															$op = $stk_trans_to == $key->m_str_id ? 'selected' : '';
															echo '<option value="' . $key->m_str_id . '" ' . $op . '>' . $key->m_str_name . '</option>';
														}
													} ?>

												</select>
											</div>
										</div>

										<div class="col-md-12 mb-2">

											<div class="table-responsive">

												<table class="table table-striped table-bordered dt-responsive nowra">
													<thead>
														<th>Sn</th>
														<th>Product Name</th>
														<th>Batch Number</th>
														<th>Quantity</th>
														<th>Package</th>
														<th>Size</th>
														<th></th>
													</thead>
													<tbody id="tableblock">
														<?php $total_qty = 0; if (!empty($id)) {
															$cou = 0;
															foreach ($edit_value as $kry) {
																$total_qty += $kry->stk_trans_qty;
																$cou++;
														?>
																
																<tr id="rowcot<?= $cou ?>">
																	<td id="rowcount$<?= $cou ?>"><?= $cou ?></td>
																	<td id="item_name<?= $cou ?>"><?= $kry->m_pro_name ?></td>
																	<td id="item_batch<?= $cou ?>"><?= $kry->m_batch_number ?></td>
																	<td><input type="hidden" name="stk_trans_id[]" id="stk_trans_id<?= $cou ?>" value="<?= $kry->stk_trans_id ?>">
																		<input type="hidden" name="stk_trans_prod[]" id="stk_trans_prod<?= $cou ?>" value="<?= $kry->stk_trans_prod ?>">
																		<input type="hidden" name="stk_trans_batch[]" id="stk_trans_batch<?= $cou ?>" data-avlqty="<?= ($kry->balance_qty+$kry->stk_trans_qty) ?>" value="<?= $kry->stk_trans_batch ?>">
																		<input type="number" id="stk_trans_qty<?= $cou ?>" name="stk_trans_qty[]" class="prodqty checkqty" data-count="<?= $cou ?>" style="width:80px" value="<?= $kry->stk_trans_qty ?>">
																		<input type="hidden" name="pre_item_qty[]" value="<?= $kry->stk_trans_qty ?>">
																	</td>
																	<td id="item_pckage<?= $cou ?>"><?= $kry->package_name ?></td>
																	<td id="item_size<?= $cou ?>"><?= $kry->size_name ?></td>
																	<td> <button type="button" class="btn btn-danger px-1 py-0 delete-stocktrans" data-dtype="2" data-value="<?= $kry->stk_trans_id ?>" title="Delete"><i class="fa fa-trash"></i></button></td>
																</tr>

														<?php  }
															echo '<input type="hidden" id="rowunt" value="' . $cou . '">';
														}
														?>

														<input type="hidden" id="rowunt" value="0">
													</tbody>
													<tfoot>
														<tr>
															<td colspan="3">Total </td>
															<td id="qty_total"><?= $total_qty?></td>
															<td colspan="3"></td>
														</tr>
													</tfoot>
												</table>

												<input list="items_datalist" id="item_serch_inp" placeholder="Add Product" class="form-control" style="width: 50%; margin-bottom:5px;">

												<datalist id="items_datalist">
													<?php
													if (!empty($batch_value)) {
														foreach ($batch_value as $Vitem) {
													?>
															<option value="<?= $Vitem->m_pro_name; ?>" data-prodid="<?= $Vitem->m_batch_pro_id ?>" data-batchid="<?= $Vitem->m_batch_id ?>" data-batchno="<?= $Vitem->m_batch_number ?>" data-avlbal="<?= $Vitem->balance_qty ?>" data-pckgname="<?= $Vitem->package_name ?>" data-sizename="<?= $Vitem->size_name ?>" data-warehseid="<?= $Vitem->m_batch_ware_id ?>"><?= $Vitem->m_pro_name . ' - ' . $Vitem->m_batch_number; ?></option>
													<?php
														}
													}
													?>
												</datalist>
											</div>
										</div>

										<div class="col-md-9">
											<div class="form-group d-flex">
												<label class="mr-3 mt-3">Remark</label>
												<input type="text" name="stk_trans_remark" id="stk_trans_remark" class="form-control" placeholder="Enter Remark" value="<?= $stk_trans_remark ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="d-flex">
												<button type="submit" id="btn-add-stocktrans" class="btn btn-block btn-info mr-2">Save</button>
												<a href="<?php echo site_url('Invoice/stock_transfer_list') ?>" class="btn btn-block btn-danger">Cancel </a>
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
<?php $this->view('Invoice/js/stock_js') ?>