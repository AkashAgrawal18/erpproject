<?php $this->view('Includes/header'); ?>

<?php $roll_id = $this->session->userdata('roll_id');
$user_type = $this->session->userdata('user_type');
if ($pgtype == 1) {
	$relink = "status_list";
	$headname = "Status";
	$Md = "LDS";
	$Smd = "STS";
} else if ($pgtype == 2) {
	$relink = "source_list";
	$headname = "Source";
	$Md = "LDS";
	$Smd = "SRC";
}
?>


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
							<table id="status_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th><?= $headname ?> Name</th>
										<th>Order</th>
										<?php if ($pgtype == 1) {
											echo '<th>Follow Up</th>';
										} ?>
										<th>Status</th>
										<th>Action</th>
									</tr>

								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('Leads/' . $relink . '?id=') . $value->m_status_id;
									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_status_name; ?></td>
												<td><?php echo $value->m_status_order; ?></td>
												<?php if ($pgtype == 1) { ?>
													<td><?php echo $value->m_status_followup == 1 ? 'YES' : 'NO'; ?></td>
												<?php } ?>
												<td>
													<?php
													if (!empty($value->m_status_status == 1)) {
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
													<?php if ($user_type == 1 || has_perm($roll_id, $Md, $Smd, 'Edit')) { ?>
														<a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<?php }
													if ($user_type == 1 || has_perm($roll_id, $Md, $Smd, 'Delete')) { ?>
														<button class="btn btn-danger btn-sm delete-status" data-value="<?php echo $value->m_status_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
				<?php $fild = !empty($id) ? "Edit" : "Add";
				if ($user_type == 1 || has_perm($roll_id, $Md, $Smd, $fild)) { ?>
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
								<form method="post" action="#" id="frm-add-status">

									<?php if (!empty($edit_value)) {
										$id = $edit_value->m_status_id;
										$title = $edit_value->m_status_name;
										$pgtype = $edit_value->m_status_type;
										$status = $edit_value->m_status_status;
										$status_order = $edit_value->m_status_order;
										$status_followup = $edit_value->m_status_followup;
									} else {
										$id = '';
										$title = '';
										$status = 1;
										$status_order = '';
										$status_followup = '';
									} ?>
									<div class="row">
										<div class="col-md-12">

											<div class="form-group">
												<label><?= $headname ?> Name<span class="text-danger">*</span></label>
												<input type="hidden" name="m_status_id" id="m_status_id" value="<?= $id ?>">
												<input type="hidden" name="m_status_type" id="m_status_type" value="<?= $pgtype ?>">
												<input type="text" name="m_status_name" id="m_status_name" class="form-control" placeholder="Enter Name" required="" value="<?= $title ?>">
											</div>
											<div class="form-group">
												<label> Order<span class="text-danger">*</span></label>
												<input type="number" name="m_status_order" id="m_status_order" class="form-control" placeholder="Enter Order" required value="<?= $status_order ?>">
											</div>
											<?php if ($pgtype == 1) { ?>
												<div class="form-group">
													<label> Ask Followup ? <span class="text-danger">*</span></label>
													<select name="m_status_followup" id="m_status_followup" class="form-control" title="Select Followup">
														<option value="1" <?php if ($status_followup == 1) echo 'selected'; ?>>YES</option>
														<option value="0" <?php if ($status_followup == 0) echo 'selected'; ?>>NO</option>
													</select>
												</div>
											<?php } ?>

											<div class="form-group">
												<label>Status</label>
												<select name="m_status_status" id="m_status_status" class="form-control" title="Select Status">
													<option value="1" <?php if ($status == 1) echo 'selected'; ?>>Active</option>
													<option value="0" <?php if ($status == 0) echo 'selected'; ?>>In-Active</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-layout-submit">
												<button type="submit" id="btn-add-status" class="btn btn-block btn-info">Submit</button>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-layout-submit">
												<a href="<?php echo site_url('Leads/' . $relink) ?>" class="btn btn-block btn-danger">Cancel </a>

											</div>
										</div>
									</div>
								</form>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->

					</div>
				<?php } ?>
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
<?php $this->view('Leads/js/js_lead') ?>