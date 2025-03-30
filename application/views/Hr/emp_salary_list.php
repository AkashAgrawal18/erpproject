<?php $this->view('Includes/header'); ?>

<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type');

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-4">
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-8">
				<?php if ($logged_user_type == 1 || has_perm($roll_id, 'FNC', 'EMPSLR', 'Filter')) { ?>

					<form method="post" action="<?php echo site_url('Report/emp_salary_list') ?>">
						<div class="row">
							<div class="col-sm-4">
								<label class="form-check-label">Month</label>
								<input type="month" class="form-control" name="from_month" value="<?php echo $from_month; ?>">
							</div>
							<div class="col-sm-4">
								<label class="form-check-label">Employee</label>
								<select name="emp_id" class="form-control" id="emp_id" >
								<option value="">All Employee</option>
									<?php if (!empty($emp_list)) {
										foreach ($emp_list as $key) {
											if ($emp_id == $key->m_emp_id) {
												$op = 'selected';
											} else {
												$op = '';
											}
											echo '<option value="' . $key->m_emp_id . '" ' . $op . '>' . $key->m_emp_name . '</option>';
										}
									} ?>

								</select>
							</div>

							<div class="col-sm-4">
								<div class="form-group mt-4">
									<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
									<a href="<?php echo site_url('Report/emp_salary_list') ?>">
										<button class="btn btn-danger" type="button"><i class="fa fa-redo"></i></button>
									</a>
									<!-- <button class="btn btn-success" type="submit" name="Excel" value="2">Export</button>  -->
								</div>
							</div>
						</div>
					</form>
<?php }?>
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
						<?php if ($logged_user_type == 1 || has_perm($roll_id, 'FNC', 'EMPSLR', 'List')) { ?>
							<table id="dept_tbl" class="table table-bordered datatable">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Employee</th>
										<th>Salary</th>
										<th>Total Days</th>
										<th>Present</th>
										<th>Absent</th>
										<th>Leave</th>
										<th>Payable</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($emp_att)) {
										foreach ($emp_att as $value) {

									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_emp_name; ?></td>
												<td><?php echo $value->m_salinst_salary; ?></td>
												<td><?php echo $value->m_salinst_totaldays; ?></td>
												<td><?php echo $value->m_salinst_prdays; ?></td>
												<td><?php echo $value->m_salinst_absent; ?></td>
												<td><?php echo $value->m_salinst_lvdays; ?></td>
												<td><?php echo $value->m_salinst_payable; ?></td>

											</tr>
									<?php
											$i++;
										}
									}
									?>

								</tbody>
							</table>
							<?php } ?>
						</div>
						<!-- /.card-body -->

					</div>

				</div>

			</div>
			<!-- /.row -->

		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->view('Includes/footer')  ?>
<?php $this->view('js/js_custom') ?>
