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
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-6 text-right">
					<a href="<?php echo site_url('General/store_add?type=' . $pgtype) ?>" class="btn btn-sm btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New</a>
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
							<table id="store_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Name</th>
										<th>Code</th>
										<?php if ($pgtype == 1) {
											echo '<th>Opening Time</th>
											<th>Closing time</th>
										<th>Manager Name</th>
										<th>Mobile</th>';
										} else {
											echo '<th>Location</th>';
										} ?>
										<th>Status</th>
										<th style="width: 15%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('General/store_add?type=' . $pgtype . '&id=') . $value->m_str_id;
									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_str_name; ?></td>
												<td><?php echo $value->m_str_code; ?></td>
												<?php if ($pgtype == 1) {
													echo '<td>' . $value->m_str_opening_time . '</td>
												<td>' . $value->m_str_closing_time . '</td>
												<td>' . $value->m_str_manage_name . '</td>
												<td>' . $value->m_str_mobile . '</td>';
												} else {
													echo '<td>' . $value->m_str_address . '</td>';
												} ?>
												<td>
													<?php
													if (!empty($value->m_str_status == 1)) {
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
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'STRFCT', 'Edit')) { ?>
														<a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a> <?php } ?>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'STRFCT', 'Delete')) { ?>
														<button class="btn btn-danger btn-sm delete-store" data-value="<?php echo $value->m_str_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button> <?php } ?>
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
<?php $this->view('js/js_hr') ?>