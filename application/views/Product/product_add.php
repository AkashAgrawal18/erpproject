<?php $this->view('Includes/header') ?>
<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-10">
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-2 text-right">
					<a href="<?php echo site_url('Product/product_list') ?>" class="btn btn-sm btn-info">Product List </a>
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
				<?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT', 'PDT', 'Add')) { ?>

							<form method="post" action="#" id="frm-add-product">
								<?php if (!empty($edit_value)) {
									$id = $edit_value->m_pro_id;
									$proname = $edit_value->m_pro_name;
									$cate = $edit_value->m_pro_cate;
									$subcate = $edit_value->m_pro_subcate;
									$pack = $edit_value->m_pro_pack;
									$size = $edit_value->m_pro_size;
									$brand = $edit_value->m_pro_brand;
									$proimg = $edit_value->m_pro_pic;
									// $price = $edit_value->m_pro_price;
									$desc = $edit_value->m_pro_desc;
									$status = $edit_value->m_pro_status;
								} else {
									$id = '';
									$proname = '';
									$cate = '';
									$subcate = '';
									$pack = '';
									$size = '';
									$brand = '';
									$proimg = '';
									// $price = '';
									$desc = '';
									$status = 1;
								} ?>

								<div class="row">
									<input type="hidden" name="m_pro_id" id="m_pro_id" value="<?= $id ?>">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Product Name<span class="text-danger">*</span></label>
											<input type="text" name="m_pro_name" placeholder="Product Name" value="<?= $proname ?>" required class="form-control"> 
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Category</label> 
											<select name="m_pro_cate" id="m_pro_cate" class="form-control select2">
												<?php if (!empty($cate_value)) {
													foreach ($cate_value as $key) {
														if ($cate == $key->m_cat_id) {
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

									<div class="col-sm-3">
										<div class="form-group">
											<label>Sub Category</label> 
											<select name="m_pro_subcate" id="m_pro_subcate" class="form-control select2">
												<?php if (!empty($subcate_value)) {
													foreach ($subcate_value as $key) {
														if ($subcate == $key->m_cat_id) {
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
									<div class="col-sm-3">
										<div class="form-group">
											<label>Package</label> 
											<select name="m_pro_pack" id="m_pro_pack" class="form-control select2">
												<?php if (!empty($pack_value)) {
													foreach ($pack_value as $key) {
														if ($pack == $key->m_cat_id) {
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
									<div class="col-sm-3">
										<div class="form-group">
											<label>Size</label> 
											<select name="m_pro_size" id="m_pro_size" class="form-control select2">
												<?php if (!empty($size_value)) {
													foreach ($size_value as $key) {
														if ($size == $key->m_cat_id) {
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
									<div class="col-sm-3">
										<div class="form-group">
											<label>Brand</label> 
											<select name="m_pro_brand" id="m_pro_brand" class="form-control select2">
												<?php if (!empty($brand_value)) {
													foreach ($brand_value as $key) {
														if ($brand == $key->m_cat_id) {
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
									<!-- <div class="col-sm-3">
										<div class="form-group">
											<label>Price</label>
											<select name="m_pro_price" id="m_pro_price" class="form-control" title="Select Status">
												<option value="1" <?php //if ($price == 1) echo 'selected' ?>>MRP</option>
												<option value="2" <?php //if ($price == 2) echo 'selected' ?>>Actual</option>
											</select>
										</div>
									</div> -->
									<div class="col-sm-3">
										<div class="form-group">
											<label>Status</label>
											<select name="m_pro_status" id="m_pro_status" class="form-control" title="Select Status">
												<option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
												<option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<?php
											if (!empty($proimg) && file_exists('uploads/productimg/' . $proimg)) {
												$catepic = base_url('uploads/productimg/' . $proimg);
											} else {
												$catepic = base_url('uploads/productimg/default.png');
											}
											?>
											<label class="control-label">Image</label>
											<input type="hidden" name="proimg" value="<?php echo $proimg ?>">
											<input type="file"   name="m_pro_pic" class="form-control">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Description </label>
											<textarea name="m_pro_desc" id="m_pro_desc" class="form-control" placeholder="Description"><?= $desc ?></textarea>
										</div>
									</div>

								
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-layout-submit">
											<button type="submit" id="btn-add-product" class="btn btn-block btn-info">Submit</button>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-layout-submit">
											<a href="<?php echo site_url('Product/product_add') ?>" class="btn btn-block btn-danger">Cancel </a>

										</div>
									</div>
								</div>
							</form>
							<?php }?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->view('Includes/footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_hr') ?>
 