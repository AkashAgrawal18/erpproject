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
					<h1><?= $pagename ?></h1>
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

													<button type="button" title="View"
														class="btn btn-info btn-vsm view-employee"
														data-toggle="modal"
														data-target="#myModal"
														data-emp-id="<?= $value->m_emp_id; ?>"
														data-emp-code="<?= $value->m_emp_code; ?>"
														data-emp-gtype="<?= $value->m_login_type; ?>"
														data-emp-name="<?= $value->m_emp_name; ?>"
														data-emp-fname="<?= $value->m_emp_fhname; ?>"
														data-emp-email="<?= $value->m_emp_email; ?>"
														data-emp-altemail="<?= $value->m_emp_altemail; ?>"
														data-emp-laddress="<?= $value->m_emp_laddress; ?>"
														data-emp-paddress="<?= $value->m_emp_paddress; ?>"
														data-emp-store="<?= $value->m_emp_store; ?>"
														data-emp-dob="<?= $value->m_emp_dob; ?>"
														data-emp-doj="<?= $value->m_emp_doj; ?>"
														data-emp-dol="<?= $value->m_emp_dol; ?>"
														data-emp-dshift="<?= $value->m_emp_dshift; ?>"
														data-emp-dtype="<?= $value->m_emp_dtype; ?>"
														data-emp-rest="<?= $value->m_emp_rest; ?>"
														data-emp-salary="<?= $value->m_emp_salary; ?>"
														data-emp-empr="<?= $value->m_emp_prev_empr; ?>"
														data-emp-dept="<?= $value->m_emp_prev_dept; ?>"
														data-emp-design="<?= $value->m_emp_prev_design; ?>"
														data-emp-duration="<?= $value->m_emp_prev_duration; ?>"
														data-emp-password="<?= $value->m_emp_password; ?>"
														data-emp-qualification="<?= $value->m_emp_qualification; ?>"
														data-emp-epfno="<?= $value->m_emp_epfno; ?>"
														data-emp-esicno="<?= $value->m_emp_esicno; ?>"
														data-emp-eltype="<?= $value->m_emp_login_type; ?>"
														data-emp-tdsappli="<?= $value->is_tds_applicable; ?>"
														data-emp-status="<?= $value->m_emp_status; ?>"
														data-emp-addedon="<?= $value->m_emp_added_on; ?>">
														<i class="fa fa-eye"></i>
													</button>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'EMP', 'Edit')) { ?>
														<a href="<?php echo base_url('HrDept/edit_employee?id=') . $value->m_emp_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<?php } ?>
													<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'EMP', 'Delete')) { ?>
														<button class="btn btn-danger btn-action delete-employe" data-value="<?php echo $value->m_emp_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Employee Details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-4">
						<p><strong>Employee ID:</strong> <span id="employeeId">N/A</span></p>
						<p><strong>Employee Code:</strong> <span id="empcode">N/A</span></p>
						<p><strong>Employee Login Type:</strong> <span id="empgtype">N/A</span></p>
						<p><strong>Employee Name:</strong> <span id="empname">N/A</span></p>
						<p><strong>Father Name:</strong> <span id="empfname">N/A</span></p>
					</div>
					<div class="col-sm-4">
						<p><strong>Email:</strong> <span id="empmail">N/A</span></p>
						<p><strong>Alt Mobile:</strong> <span id="empaltemail">N/A</span></p>
						<p><strong>Local Address:</strong> <span id="empladdress">N/A</span></p>
						<p><strong>Permanent Address:</strong> <span id="empaddress">N/A</span></p>
						<p><strong>Store:</strong> <span id="empstore">N/A</span></p>

					</div>
					<div class="col-sm-4">
						<p><strong>DOB:</strong> <span id="empdob">N/A</span></p>
						<p><strong>DOJ:</strong> <span id="empdoj">N/A</span></p>
						<p><strong>Date of Leave:</strong> <span id="empdol">N/A</span></p>
						<p><strong>Duty Shift:</strong> <span id="empdshift">N/A</span></p>
						<p><strong>Duty Type:</strong> <span id="empdtype">N/A</span></p>
					</div>
					<div class="col-sm-4">
						<p><strong>Rest Day:</strong> <span id="emprest">N/A</span></p>
						<p><strong>Basic Salary:</strong> <span id="empsalary">N/A</span></p>
						<p><strong>Previous Employer:</strong> <span id="empempr">N/A</span></p>
						<p><strong>Department :</strong> <span id="empdept">N/A</span></p>
						<p><strong>Designation :</strong> <span id="empdesign">N/A</span></p>
					</div>
					<div class="col-sm-4">
						<p><strong>Duration:</strong> <span id="empduration">N/A</span></p>
						<p><strong>Password:</strong> <span id="emppassword">N/A</span></p>
						<p><strong>Qualification:</strong> <span id="empqualification">N/A</span></p>
						<p><strong>EPF Number:</strong> <span id="empepfno">N/A</span></p>
						<p><strong>ESIC Number:</strong> <span id="empesicno">N/A</span></p>
					</div>
					<div class="col-sm-4">
						<p><strong>Login Type:</strong> <span id="empeltype">N/A</span></p>
						<p><strong>Is EPF Applicable:</strong> <span id="emptdsappli">N/A</span></p>
						<p><strong>Status:</strong> <span id="empstatus">N/A</span></p>
						<p><strong>Date:</strong> <span id="empaddedon">N/A</span></p>
					</div>

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
	$(document).on('click', '.view-employee', function() {
		var empId = $(this).data('emp-id');
		var ecode = $(this).data('emp-code');
		var egtype = $(this).data('emp-gtype');
		var ename = $(this).data('emp-name');
		var efName = $(this).data('emp-fname');
		var email = $(this).data('emp-email');
		var ealtemail = $(this).data('emp-altemail');
		var eladdress = $(this).data('emp-laddress');
		var epaddress = $(this).data('emp-paddress');
		var estore = $(this).data('emp-store');
		var edob = $(this).data('emp-dob');
		var edoj = $(this).data('emp-doj');
		var edol = $(this).data('emp-dol');
		var edshift = $(this).data('emp-dshift');
		var edtype = $(this).data('emp-dtype');
		var erest = $(this).data('emp-rest');
		var esalary = $(this).data('emp-salary');
		var eempr = $(this).data('emp-empr');
		var edept = $(this).data('emp-dept');
		var edesign = $(this).data('emp-design');
		var eduration = $(this).data('emp-duration');
		var epassword = $(this).data('emp-password');
		var equalification = $(this).data('emp-qualification');
		var eepfno = $(this).data('emp-epfno');
		var eesicno = $(this).data('emp-esicno');
		var eeltype = $(this).data('emp-eltype');
		var etdsappli = $(this).data('emp-tdsappli');
		var estatus = $(this).data('emp-status');
		var eaddedon = $(this).data('emp-addedon');
		$('#employeeId').text(empId);
		$('#empcode').text(ecode);
		$('#empgtype').text(egtype);
		$('#empname').text(ename);
		$('#empfname').text(efName);
		$('#empmail').text(email);
		$('#empaltemail').text(ealtemail);
		$('#empladdress').text(eladdress);
		$('#empaddress').text(epaddress);
		$('#empstore').text(estore);
		$('#empdob').text(edob);
		$('#empdoj').text(edoj);
		$('#empdol').text(edol);
		$('#empdshift').text(edshift);
		$('#empdtype').text(edtype);
		$('#emprest').text(erest);
		$('#empsalary').text(esalary);
		$('#empempr').text(eempr);
		$('#empdept').text(edept);
		$('#empdesign').text(edesign);
		$('#empduration').text(eduration);
		$('#emppassword').text(epassword);
		$('#empqualification').text(equalification);
		$('#empepfno').text(eepfno);
		$('#empesicno').text(eesicno);
		$('#empeltype').text(eeltype);
		$('#emptdsappli').text(etdsappli);
		$('#empstatus').text(estatus);
		$('#empaddedon').text(eaddedon);
	});
</script>