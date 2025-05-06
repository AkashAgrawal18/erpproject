<?php $this->view('Includes/header'); ?>

<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3><?= $pagename ?></h3>
				</div>
				<div class="col-sm-6 text-right">
					<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'EMP', 'Add')) {  ?>
						<a href="<?php echo site_url('HrDept/add_employe') ?>" class="btn btn-sm btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Employee</a>
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
							<table id="employe_tbl" class="table table-bordered datatable  ">
								<thead>
									<tr>
										<th>Sno.</th>
										<th>EmpCode</th>
										<th>EmpName</th>
										<th>DOJ</th>
										<th>Mobile No</th>
										<th>Email</th>
										<th>Desig</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($emp_value)) {
										foreach ($emp_value as $value) {

									?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $value->m_emp_code; ?></td>
												<td><?php echo $value->m_emp_name; ?></td>
												<td><?= date('d-m-Y', strtotime($value->m_emp_doj)); ?></td>
												<td><?php echo $value->m_emp_mobile; ?></td>
												<td><?php echo $value->m_emp_email; ?></td>
												<td><?php echo $value->m_dept_name; ?></td>

												<td><?php if ($value->m_emp_status == 1) echo "Active";
													else {
														echo "In-Active";
													} ?></td>

												<td class="wd-30">
													<button type="button" onclick="viewdetailmodal('<?= $value->m_emp_id ?>')" title="View" class="btn btn-info btn-sm "> <i class="fa fa-eye"></i></button>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'EMP', 'Edit')) { ?>
														<a href="<?php echo base_url('HrDept/add_employe?id=') . $value->m_emp_id; ?>" class="btn btn-info btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<?php } ?>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'EMP', 'Delete')) { ?>
														<button class="btn btn-danger btn-sm delete-employe" data-value="<?php echo $value->m_emp_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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

			</div>
			<!-- /.row -->

		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Structure -->
<div class="modal fade" id="employee_detail_modal">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Employee Details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal Body -->
			<div class="modal-body">
				<h5>Personal Details</h5>
				<div class="row g-4" id="personaldetaildiv">
				</div>
				<hr>
				<h5>Previous Employer Details</h5>
				<div class="row g-4" id="previousempdiv">
				</div>
				<hr>
				<h5>Official Details</h5>
				<div class="row g-4" id="officialdtldiv">
				</div>
				<hr>
				<h5>Account Details</h5>
				<div class="row g-4" id="accountdetaildiv">
				</div>

			</div>

			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>



<?php $this->view('Includes/footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_hr') ?>

<script>
	function viewdetailmodal(empid) {
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('HrDept/get_emp_details'); ?>",
			data: {
				empid
			},
			dataType: "JSON",
			success: function(data) {
				if (data) {

					$('#personaldetaildiv').html(`<div class="col-sm-4">
						<strong>Employee Code:</strong> <span id="empcode">${data.m_emp_code || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Employee Name:</strong> <span id="empname">${data.m_emp_name || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Father Name:</strong> <span id="empfname">${data.m_emp_fhname || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
						<strong>Mobile:</strong> <span id="empaltemail">${data.m_emp_mobile || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
						<strong>Alt Mobile:</strong> <span id="empaltemail">${data.m_emp_altmobile || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Email:</strong> <span id="empmail">${data.m_emp_email || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Alt Email:</strong> <span id="empaltmail">${data.m_emp_altemail || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>DOB:</strong> <span id="empdob">${data.m_emp_dob || 'N/A'}</span>
						</div>
						<div class="col-sm-6">
							<strong>Local Address:</strong> <span id="empladdress">${data.m_emp_laddress || 'N/A'}</span>
						</div>
						<div class="col-sm-6">
							<strong>Permanent Address:</strong> <span id="empaddress">${data.m_emp_paddress || 'N/A'}</span>
					</div>`);

					$('#previousempdiv').html(`
						<div class="col-sm-4">
							<strong>Previous Employer:</strong> <span id="preempyer">${data.m_emp_prev_empr || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Previous Department:</strong> <span id="predeprt">${data.m_emp_prev_dept || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Previous Designation:</strong> <span id="predesg">${data.m_emp_prev_design || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Experience:</strong> <span id="empexp">${data.m_emp_prev_duration || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Qualification:</strong> <span id="empqual">${data.m_emp_qualification || 'N/A'}</span>
						</div>
						
					`);
					$('#officialdtldiv').html(`
						<div class="col-sm-4">
							<strong>Store:</strong> <span id="empstore">${data.store_name || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>DOJ:</strong> <span id="empdoj">${data.m_emp_doj || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Department :</strong> <span id="empdept">${data.depart_name || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Designation :</strong> <span id="empdesign">${data.design_name || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Duty Shift:</strong> <span id="empdshift">${data.shift_name || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Duty Type:</strong> <span id="empdtype">${data.m_emp_dtype || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Rest Day:</strong> <span id="emprest">${data.rest_day || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Total Leave: </strong> <span id="empleave">${data.m_emp_yearly || 'N/A'}</span>
						</div>
					`);

					$('#accountdetaildiv').html(`
						<div class="col-sm-4">
							<strong>Roll:</strong> <span id="emproll">${data.roll_name || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Reporting to:</strong> <span id="empreport">${data.reported_to || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Login id :</strong> <span id="emplogin">${data.m_emp_email || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Password :</strong> <span id="emppass">${data.m_emp_password || 'N/A'}</span>
						</div>
						<div class="col-sm-4">
							<strong>Status :</strong> <span id="emppass">${data.m_emp_status == 1?'Active':'In-Active'}</span>
						</div>
										
					`);

					$('#employee_detail_modal').modal('show');
				} else {
					swal("Data Not Found! Please Try Again", {
						icon: "error",
						timer: 5000,
					});
				}
			}
		});
	}
</script>