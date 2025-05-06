<?php $this->view('Includes/header') ?>
<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type');
$relink = "store_wise_stock";
// $headname = "Designation";
$Md = "RPT";
$Smd = "STKRPT";

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-3">
					<h3><?= $pagename ?></h3>
				</div>
				<div class="col-sm-8">
					<?php if ($logged_user_type == 1 || has_perm($roll_id, $Md, $Smd, 'Filter')) { ?>

						<form method="post" action="<?php echo site_url('Report/' . $relink) ?>">
							<div class="row">
								<div class="col-sm-3">
									<label class="form-check-label">Date</label>
									<input type="date" class="form-control" name="to_date" value="<?= $to_date; ?>" onchange="this.form.submit()">
								</div>
								<div class="col-sm-3">
									<label class="form-check-label">Store</label>
									<select name="m_store" id="m_store" class="form-control select2" onchange="this.form.submit()">
										<option value="">All Store</option>
										<?php if (!empty($store_value)) {
											foreach ($store_value as $key) {
												if (!empty($user_store)) {
													if ($m_store == $key->m_str_id) {
														$op = 'selected';
													} else {
														$op = '';
													}
													if ($user_store == $key->m_str_id) {
														echo '<option value="' . $key->m_str_id . '" ' . $op . '>' . $key->m_str_name . '</option>';
													}
												} else {
													if ($m_store == $key->m_str_id) {
														$op = 'selected';
													} else {
														$op = '';
													}
													echo '<option value="' . $key->m_str_id . '" ' . $op . '>' . $key->m_str_name . '</option>';
												}
											}
										} ?>

									</select>
								</div>
								<div class="col-sm-3">
									<label class="form-check-label">Category</label>
									<select name="m_cate" id="m_cate" class="form-control select2" onchange="this.form.submit()">
										<option value="">All Category</option>
										<?php if (!empty($cate_value)) {
											foreach ($cate_value as $key) {
												if ($m_cate == $key->m_cat_id) {
													$op = 'selected';
												} else {
													$op = '';
												}
												echo '<option value="' . $key->m_cat_id . '" ' . $op . '>' . $key->m_cat_name . '</option>';
											}
										} ?>

									</select>
								</div>
								<div class="col-sm-3">
									<label class="form-check-label">Sub Category</label>
									<select name="m_subcate" id="m_subcate" class="form-control select2" onchange="this.form.submit()">
										<option value="">All Sub Category</option>
										<?php if (!empty($subcate_value)) {
											foreach ($subcate_value as $key) {
												if ($m_subcate == $key->m_cat_id) {
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
						</form>
					<?php } else {
						if ($logged_user_type == 1 || has_perm($roll_id, $Md, $Smd, 'List')) {
							echo '<a href="' . site_url('Report/emp_salary_list') . '">
											<button class="btn btn-danger" type="button"><i class="fa fa-redo"></i></button>
										</a>';
						}
					} ?>
				</div>
				<div class="col-sm-1">
					<div class="form-group mt-4">
						<?php if ($logged_user_type == 1 || has_perm($roll_id, $Md, $Smd, 'List')) { ?>
							<a href="<?php echo site_url('Report/' . $relink) ?>">
								<button class="btn btn-danger" type="button"><i class="fa fa-redo"></i></button>
							</a>
						<?php } ?>
						<!-- <button class="btn btn-success" type="submit" name="Excel" value="2">Export</button>  -->
					</div>
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
										<th>Product Name</th>
										<th>Package/Size</th>
										<th>Category/Sub Category</th>
										<th>Opening Stock</th>
										<th>Today's Packed</th>
										<th>Today's Sale</th>
										<th>Closing Stock</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($all_value)) {
										foreach ($all_value as $value) {

									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_pro_name; ?></td>
												<td><?php echo $value->package_name . ' ' . $value->size_name; ?></td>
												<td><?php echo $value->category_name . '/' . $value->subcategory_name; ?></td>
												<td><?php echo $value->opening_stock; ?></td>
												<td><?php echo $value->todays_pkg; ?></td>
												<td><?php echo $value->todays_sale; ?></td>
												<td><?php echo $value->closing_stock; ?></td>


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
<?php $this->view('js/js_hr') ?>