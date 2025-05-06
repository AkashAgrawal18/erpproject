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
					<?php if ($logged_user_type == 1 || has_perm($roll_id, 'INV', 'INV', 'Add')) { ?>
						<a href="<?php echo site_url('Invoice/invoice_add') ?>" class="btn btn-sm btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New</a>
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
										<th>Invoice No</th>
										<th>Entity Name</th>
										<th>Entity Mobile</th>
										<th>Store</th>
										<th>Amount</th>
										<th>Total Discount</th>
										<th>Total Tax</th>
										<th>Net Total</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('Invoice/invoice_add?id=') . $value->m_inv_id;
									?>
											<tr>
												<td><?= $i; ?></td>
												<td><?= date('d-m-Y', strtotime($value->m_inv_date)); ?></td>
												<td><?= $value->m_inv_no; ?></td>
												<td><?= $value->m_entity_name; ?></td>
												<td><?= $value->m_entity_mobile; ?></td>
												<td><?= $value->m_str_name; ?></td>
												<td><?= $value->m_inv_amount; ?></td>
												<td><?= $value->m_inv_discount; ?></td>
												<td><?= $value->m_inv_cgst + $value->m_inv_sgst + $value->m_inv_igst; ?></td>
												<td><?= $value->m_inv_totalamt; ?></td>

												<td title="Action" style="white-space: nowrap;">
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'INV', 'INV', 'Edit')) { ?>
														<a href="<?php echo $edit_link; ?>" class="btn btn-info btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<?PHP } ?>
													 	<a href="<?= site_url('Invoice/invoice_print?type=1&id=') . $value->m_inv_id; ?>" class="btn btn-success btn-sm" title="Download PDF" ><i class="fa fa-download"></i></a>
													 	<a href="<?= site_url('Invoice/invoice_print?type=2&id=') . $value->m_inv_id; ?>" class="btn btn-success btn-sm" title="Print" ><i class="fa fa-print"></i></a>
												
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'INV', 'INV', 'Delete')) { ?>
														<button class="btn btn-danger btn-sm delete-invoice" data-dtype="1" data-value="<?php echo $value->m_inv_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
<?php $this->view('Invoice/js/invoice_js') ?>