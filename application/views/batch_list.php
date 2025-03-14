<?php $this->view('header') ?>
<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-6 text-right">
					<a href="<?php echo site_url('Product/batch_add') ?>" class="btn btn-sm btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Batch</a>

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
							<table id="batch_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Batch Number</th>
										<th>Product </th>
										<th>Quntity</th> 
										<th>Date</th> 
										<th>Expiry Period</th> 
										<th>Status</th>
										<th style="width: 15%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('Product/batch_add?id=') . $value->m_batch_id;
									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_batch_number; ?></td>
												<td><?php echo $value->m_pro_name; ?></td>
												<td><?php echo $value->m_batch_quantity; ?></td>
												<td><?php echo date('d-m-Y', strtotime($value->m_batch_date)); ?></td>
												<td><?php echo $value->m_batch_expiry_date; echo '-Month'; ?></td>
												  
												<td>
													<?php
													if (!empty($value->m_batch_status == 1)) {
													?>
														<a class="btn btn-success btn-sm" title="Active" data-toggle="Active">Active</a>
													<?php
													} else {
													?>
														<a class="btn btn-danger btn-sm" title="In-Active" data-toggle="In-Active">In-Active</a>
													<?php
													}
													?>
												</td>
												<td title="Action" style="white-space: nowrap;">
												<?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT', 'DPT', 'Edit')) { ?>
													<a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<?PHP } ?>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT', 'DPT', 'Delete')) { ?>
													<button class="btn btn-danger btn-sm delete-batch" data-value="<?php echo $value->m_batch_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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


<?php $this->view('footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_hr') ?>
