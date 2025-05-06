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
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<!-- /.card-header -->
						<div class="card-body">
							<table id="ware_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Warehouse</th>
										<th>Location</th>
										<th>Status</th>
										<th style="width: 15%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('Product/warehouse_list?id=') . $value->m_ware_id;
									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_ware_name; ?></td>
												<td><?php echo $value->m_ware_location; ?></td>
												<td>
													<?php
													if (!empty($value->m_ware_status == 1)) {
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
												<?php if ($logged_user_type == 1 || has_perm($roll_id, 'MST', 'ST', 'Edit')) { ?>
													<a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<?php } ?>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'MST', 'ST', 'Delete')) { ?>
													<button class="btn btn-danger btn-sm delete-ware" data-value="<?php echo $value->m_ware_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
													<?php } ?>
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
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php if (!empty($id)) {
														echo 'Edit Value';
													} else {
														echo 'Add New';
													} ?></h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
						<?php if ($logged_user_type == 1 || has_perm($roll_id, 'MST', 'ST', 'Add')) { ?>
							<form method="post" action="#" id="frm-add-ware">
								<?php if (!empty($edit_value)) {
									$id = $edit_value->m_ware_id;
									$title = $edit_value->m_ware_name;
									$location = $edit_value->m_ware_location;
									$status = $edit_value->m_ware_status;
								} else {
									$id = '';
									$title = '';
									$location ='';
									$status = 1;
								} ?>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Warehouse<span class="text-danger">*</span></label>
											<input type="hidden" name="m_ware_id" id="m_ware_id" value="<?= $id ?>">
											<input type="text" name="m_ware_name" id="m_ware_name" class="form-control" placeholder="Enter Warehouse" required="" value="<?= $title ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Location<span class="text-danger">*</span></label>
											<input type="text" name="m_ware_location" id="m_ware_location" class="form-control" placeholder="Enter Location" required="" value="<?= $location ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>State Status</label>
											<select name="m_ware_status" id="m_ware_status" class="form-control" title="Select Status">
												<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
												<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-layout-submit">
											<button type="submit" id="btn-add-ware" class="btn btn-block btn-info">Submit</button>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-layout-submit">
											<a href="<?php echo site_url('Product/warehouse_list') ?>" class="btn btn-block btn-danger">Cancel </a>

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
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_master') ?>
