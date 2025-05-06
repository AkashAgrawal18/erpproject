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
					<h3><?= $paLDSame ?></h3>
				</div>
				<div class="col-sm-6 text-right">
					<?php if ($logged_user_type == 1 || has_perm($roll_id, 'LDS', 'LDS', 'Add')) { ?>
						<a href="<?php echo site_url('Leads/lead_add') ?>" class="btn btn-sm btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Lead</a>
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
							<table id="lead_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Name</th>
										<th>Type </th>
										<th>Mobile</th>
										<th>Source</th>
										<th>City</th>
										<th>Assigned To</th>
										<th>Status</th>
										<th>Added By</th>
										<th>Added On</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('Leads/lead_add?id=') . $value->m_lead_id;
									?>
											<tr>
												<td><?= $i; ?></td>
												<td><?= $value->m_lead_name; ?></td>
												<td><?= $value->lead_type; ?></td>
												<td><?= $value->m_lead_mobile; ?></td>
												<td><?= $value->source_name; ?></td>
												<td><?= $value->m_city_name; ?></td>
												<td><?= $value->assigned_to; ?></td>
												<td><?= $value->status_name; ?></td>
												<td><?= $value->added_by; ?></td>
												<td><?= date('d-m-Y', strtotime($value->m_lead_addedon)); ?></td>
												<td>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'LDS', 'FWP', 'Add')) { ?>
														<button class="btn btn-info btn-sm" title="Add Followup" onclick="addfollowup_modal('<?= $value->m_lead_id; ?>')"><i class="fa fa-plus"></i></button>
													<?PHP }
													if ($logged_user_type == 1 || has_perm($roll_id, 'LDS', 'LDS', 'Edit')) { ?>
														<a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
													<?PHP } ?>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'LDS', 'LDS', 'Delete')) { ?>
														<button class="btn btn-danger btn-sm delete-lead" data-value="<?php echo $value->m_lead_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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

<!-- Modal Structure -->
<div class="modal fade" id="add_followup_modal">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="modal_title">Add Followup</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal Body -->
			<form method="post" action="#" id="frm-add-follow">
				<div class="modal-body">
					<div class="row g-4" id="leaddetaildiv">
					</div>
					<hr>
					<div class="row">
						<input type="hidden" name="m_follow_id" id="m_follow_id" value="">
						<input type="hidden" name="m_follow_lead" id="m_follow_lead">
						<input type="hidden" name="m_follow_assigned" id="m_follow_assigned">

						<div class="col-sm-4">
							<div class="form-group">
								<label>Date<span class="text-danger">*</span></label>
								<input type="date" max="<?= date('Y-m-d') ?>" name="m_follow_date" id="m_follow_date" value="<?= date('Y-m-d') ?>" required class="form-control">
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label>Is Sample Given <span class="text-danger">*</span></label>
								<select name="m_follow_sample" id="m_follow_sample" class="form-control select2" required>
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4 samplediv d-none">
							<div class="form-group">
								<label>Product</label>
								<select name="m_follow_product" id="m_follow_product" class="form-control" title="Select Product">
									<?php
									if (!empty($pro_value)) {
										foreach ($pro_value as $prod) {
									?>
											<option value="<?= $prod->m_pro_id; ?>"><?= $prod->m_pro_name; ?></option>
									<?php
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-4 samplediv d-none">
							<div class="form-group">
								<label>Piece</label>
								<input type="number" name="m_follow_piece" id="m_follow_piece" class="form-control" placeholder="Enter Piece Given">
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label>Status </label>
								<select name="m_follow_status" id="m_follow_status" class="form-control select2" title="Select Status">
									<option value="">Select Status</option>
									<?php
									if (!empty($status_value)) {
										foreach ($status_value as $stus) {
									?>
											<option value="<?= $stus->m_status_id; ?>"><?= $stus->m_status_name; ?></option>
									<?php
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label>Next Followup </label>
								<input type="date" min="<?= date('Y-m-d') ?>" name="m_follow_next" id="m_follow_next" class="form-control">
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label>Remark </label>
								<textarea class="form-control" name="m_follow_remark" id="m_follow_remark"></textarea>
							</div>
						</div>


					</div>

				</div>

				<!-- Modal Footer -->
				<div class="modal-footer">

					<div class="form-layout-submit">
						<button type="submit" id="btn-add-follow" class="btn btn-info">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->view('Includes/footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('Leads/js/js_lead') ?>

