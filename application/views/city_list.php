<?php $this->view('header') ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $pagename ?></h1>
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
							<table id="city_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Name</th>
										<th>State</th>
										<th>Status</th>
										<th style="width: 15%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('Master/city_list?id=') . $value->m_city_id;
									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_city_name; ?></td>
												<td><?php echo $value->m_state_name; ?></td>
												<td>
													<?php
													if (!empty($value->m_city_status == 1)) {
													?>
														<a class="btn btn-success btn-action btn-sm" title="Active" data-toggle="Active">Active</a>
													<?php
													} else {
													?>
														<a class="btn btn-danger btn-action btn-sm" title="In-Active" data-toggle="In-Active">In-Active</a>
													<?php
													}
													?>
												</td>
												<td title="Action" style="white-space: nowrap;">
													<a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<button class="btn btn-danger delete-city btn-sm" data-value="<?php echo $value->m_city_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
							<form method="post" action="#" id="frm-add-city">
								<?php if (!empty($edit_value)) {
									$id = $edit_value->m_city_id;
									$State = $edit_value->m_city_state;
									$title = $edit_value->m_city_name;
									$status = $edit_value->m_city_status;
								} else {
									$id = '';
									$State = '';
									$title = '';
									$status = 1;
								} ?>


								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>State<span class="text-danger">*</span></label>
											<select name="m_city_state" id="m_city_state" class="form-control select2" title="Select Status" required>
												<option value="">Select State</option>
												<?php
												if (!empty($get_active_state)) {
													foreach ($get_active_state as $state) {
												?>
														<option value="<?php echo $state->m_state_id; ?>" <?php if ($State == $state->m_state_id) echo 'selected'; ?>><?php echo $state->m_state_name; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>City Title<span class="text-danger">*</span></label>
											<input type="hidden" name="m_city_id" id="m_city_id" value="<?= $id ?>">
											<input type="text" name="m_city_name" id="m_city_name" class="form-control" placeholder="Enter City Title" required="" value="<?= $title ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>City Status</label>
											<select name="m_city_status" id="m_city_status" class="form-control" title="Select Status">
												<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
												<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-layout-submit">
											<button type="submit" id="btn-add-city" class="btn btn-block btn-info">Submit</button>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-layout-submit">
											<a href="<?php echo site_url('Master/city_list') ?>" class="btn btn-block btn-danger">Cancel </a>

										</div>
									</div>
								</div>
							</form>
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


<?php $this->view('footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_master') ?>