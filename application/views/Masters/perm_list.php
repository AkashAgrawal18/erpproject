<?php $this->view('Includes/header') ?>


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
							<table id="perm_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th>Sn.</th>
										<th>Sub Module</th>
										<th>Key</th>
										<th>Module</th>
										<th>Module Key</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php
									if (!empty($all_value)) {
										foreach ($all_value as $i => $value) {
									?>
											<tr>
												<td><?php echo $i + 1; ?></td>
												<td><?php echo $value->m_perm_name; ?></td>
												<td><?php echo $value->m_perm_submodule_slug; ?></td>
												<td><?php echo $value->m_perm_module; ?></td>
												<td><?php echo $value->m_perm_module_slug; ?></td>
												<td><?php
													if ($value->m_perm_status == 1) {
														echo "Active";
													} else {
														echo "In-Active";
													}
													?></td>
												<td title="Action" style="white-space: nowrap;">
													<a href="<?= site_url('Master/perm_list?id=') . $value->m_perm_id ?>" class="btn btn-success btn-action" title="Edit"><i class="fa fa-edit"></i></a>
													<button class="btn btn-danger btn-action delete-perm" data-value="<?php echo $value->m_perm_id; ?>" title="Delete"><i class="fa fa-trash"></i></button>

												</td>
											</tr>
									<?php }
									} ?>
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
							<form method="post" action="#" id="frm-add-perm">

								<?php if (!empty($edit_value)) {
									$id = $edit_value->m_perm_id;
									$title = $edit_value->m_perm_name;
									$module = $edit_value->m_perm_module;
									$status = $edit_value->m_perm_status;
									$module_slug = $edit_value->m_perm_module_slug;
									$submodule_slug = $edit_value->m_perm_submodule_slug;
									$type = $edit_value->m_perm_type;
								} else {
									$id = '';
									$title = '';
									$module = '';
									$module_slug = '';
									$submodule_slug = '';
									$status = 1;
									$type = '';
								} ?>


								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Module<span class="text-danger">*</span></label>
											<input type="text" name="m_perm_module" id="m_perm_module" class="form-control" placeholder=" Enter Module" required="" value="<?= $module ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Module slug<span class="text-danger">*</span></label>
											<input type="text" name="m_perm_module_slug" id="m_perm_module_slug" class="form-control" placeholder=" Enter Module" required="" value="<?= $module_slug ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Sub Module<span class="text-danger">*</span></label>
											<input type="hidden" name="m_perm_id" id="m_perm_id" value="<?= $id ?>">
											<input type="text" name="m_perm_name" id="m_perm_name" class="form-control" placeholder=" Enter Title" required="" value="<?= $title ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Sub Module slug<span class="text-danger">*</span></label>
											<input type="text" name="m_perm_submodule_slug" id="m_perm_submodule_slug" class="form-control" placeholder=" Enter Title" required="" value="<?= $submodule_slug ?>">
										</div>
									</div>
								</div>
								<!-- <div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>Type</label>
			<select name="m_perm_type" id="m_perm_type" class="form-control select2">
				<option value="All" <?php if ($type == "All") {
										echo 'selected';
									} ?>>All</option>
				<option value="Own" <?php if ($type == "Own") {
										echo 'selected';
									} ?>>Own</option>
			</select>

		</div>
	</div>
</div> -->


								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Status</label>
											<select name="m_perm_status" id="m_perm_status" class="form-control" title="Select Status">
												<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
												<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-layout-submit">
											<button type="submit" id="btn-add-perm" class="btn btn-block btn-info">Submit</button>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-layout-submit">
											<a href="<?php echo site_url('Master/perm_list') ?>" class="btn btn-block btn-danger">Reset </a>

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


<?php $this->view('Includes/footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_master') ?>
