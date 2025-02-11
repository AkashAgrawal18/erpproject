<?php $this->view('header'); ?>

<?php $logged_user_id = $this->session->userdata('user_design');
$logged_user_type = $this->session->userdata('user_type');
if ($cattype == 1) {
	$relink = "category_list";
	$headname = "Category";
} else if ($cattype == 2) {
	$relink = "sub_category_list";
	$headname = "Sub Category";
}
?>


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
							<table id="cate_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th><?= $headname ?> Name</th>
										<th> Image</th>
										<th>Status</th>
										<th style="width: 15%">Action</th>
									</tr>

								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {
											$edit_link = site_url('Product/' . $relink . '?id=') . $value->m_cat_id;
									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_cat_name; ?></td>
												<td>
													<?php
													$cat_img = 'uploads/cate/' . $value->m_cat_img;
													if (!empty($value->m_cat_img) && file_exists($cat_img)) {
													?>
														<img src="<?php echo base_url($cat_img); ?>" alt="Category Image" class="card-img-top rounded" style="height: 30px; width: 30%;">
													<?php } else { ?>
														<img src="<?php echo base_url('uploads/cate/default.jpg'); ?>" alt="Default Image" class="card-img-top rounded" style="height: 30px; width: 30%;">
													<?php } ?>
												</td>

												<td>
													<?php
													if (!empty($value->m_cat_status == 1)) {
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
													<a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<button class="btn btn-danger btn-sm delete-cate" data-value="<?php echo $value->m_cat_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>

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
							<form method="post" action="#" id="frm-add-cate">

								<?php if (!empty($edit_value)) {
									$id = $edit_value->m_cat_id;
									$title = $edit_value->m_cat_name;
									$cattype = $edit_value->m_cat_type;
									$catimg = $edit_value->m_cat_img;
									$status = $edit_value->m_cat_status;
									$catsub = $edit_value->m_catsub_id;
								} else {
									$id = '';
									$title = '';
									$catimg = '';
									$status = '';
									$catsub = '';
								} ?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label><?= $headname ?> Name<span class="text-danger">*</span></label>
											<input type="hidden" name="m_cat_id" id="m_cat_id" value="<?= $id ?>">
											<input type="hidden" name="m_cat_type" id="m_cat_type" value="<?= $cattype ?>">
											<input type="text" name="m_cat_name" id="m_cat_name" class="form-control" placeholder="Enter Name" required="" value="<?= $title ?>">
										</div>
									</div>
								</div>
								<?php if ($cattype == 2) { ?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Category Name<span class="text-danger">*</span></label> 
											<select name="m_catsub_id" id="m_catsub_id" class="form-control select2">
														<?php if (!empty($all_subcate)) {
															foreach ($all_subcate as $key) {
																if ($catsub == $key->m_cat_id) {
																	$op = 'selected';
																} else {
																	$op = '';
																}
																echo '<option value="' . $key->m_cat_id . '" ' . $op . '>' . $key->m_cat_name . '</option>';
															}
														} ?>

													</select> 
										</div>
									</div>
								</div>
								<?php }  ?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<?php
											if (!empty($catimg) && file_exists('uploads/cate/' . $catimg)) {
												$catepic = base_url('uploads/cate/' . $catimg);
											} else {
												$catepic = base_url('uploads/cate/default.jpg');
											}
											?>
											<label class="control-label">Image</label>
											<input type="hidden" name="catimg" value="<?php echo $catimg ?>">
											<input type="file" name="m_cat_img" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Status</label>
											<select name="m_cat_status" id="m_cat_status" class="form-control" title="Select Status">
												<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
												<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-layout-submit">
											<button type="submit" id="btn-add-cate" class="btn btn-block btn-info">Submit</button>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-layout-submit">
											<a href="<?php echo site_url('Product/' . $relink) ?>" class="btn btn-block btn-danger">Cancel </a>

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
<?php $this->view('js/js_hr') ?>
