<?php $this->view('Includes/header') ?>
<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3><?= $pagename ?></h3>
				</div>
				<div class="col-sm-6 text-right">
					<?php if ($logged_user_type == 1 || has_perm($roll_id, 'INV', 'STKTN', 'Add')) { ?>
						<a href="<?php echo site_url('Invoice/stock_transfe_add') ?>" class="btn btn-sm btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New</a>
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
						<!-- /.card-header -->
						<div class="card-body">
							<table id="stocktrans_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Date</th>
										<th>Challan No</th>
										<th>From</th>
										<th>To</th>
										<th>Product</th>
										<th>Batch</th>
										<th>Qty</th>
										<th style="width: 15%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('Invoice/stock_transfe_add?id=') . $value->stk_trans_challan;
									?>
											<tr>
												<td><?= $i; ?></td>
												<td><?= date('d-m-Y', strtotime($value->stk_trans_date)); ?></td>
												<td><?= $value->stk_trans_challan; ?></td>
												<td><?= $value->trans_from; ?></td>
												<td><?= $value->trans_to; ?></td>
												<td><?= $value->product_name; ?></td>
												<td><?= $value->batch_number; ?></td>
												<td><?= $value->totalqty; ?></td>

												<td title="Action" style="white-space: nowrap;">
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'INV', 'STKTN', 'Edit')) { ?>
														<a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<?PHP } ?>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'INV', 'STKTN', 'Delete')) { ?>
														<button class="btn btn-danger btn-sm delete-stocktrans" data-dtype="1" data-value="<?php echo $value->stk_trans_challan; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
													<?PHP } ?>
												</td>
											</tr>
									<?php
											$i++;
										}
									}

									?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->

					</div>

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
<?php $this->view('js/js_custom') ?>
<?php $this->view('Invoice/js/stock_js') ?>