<?php $this->view('header'); ?>


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
				<div class="col-lg-2 mb-3 text-right">
					<div class="seipkon-breadcromb-right">
						<a href="<?php echo site_url('HrDept/add_employe') ?>" class="btn btn-sm btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Employee</a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<!-- /.card-header -->
						<div class="card-body">
							<table id="employe_tbl" class="table table-bordered datatable  ">
								<thead>
									<tr>
										<th>Sno.</th>
										<th>EmpCode</th>
										<th>Login ID</th>
										<th>EmpName</th>
										<th>DOJ</th>
										<?php if ($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') != 3 && $this->session->userdata('user_dept') == 1) {
											echo '<th>GSalary</th>
                            <th>EPF No</th>
                            <th>ESIC No</th>';
										} ?>
										<th>Pan No</th>
										<th>Mobile No</th>
										<th>BankAccNo</th>
										<!-- <th>Company</th> -->
										<!-- <th>Dept</th> -->
										<!-- <th>Desig</th> -->
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
												<td><?php echo $value->m_emp_id; ?></td>
												<td><?php echo $value->m_emp_name; ?></td>
												<td><?= date('d-m-Y h:i', strtotime($value->m_emp_doj)); ?></td>
												<?php if ($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') != 3 && $this->session->userdata('user_dept') == 1) {
													echo ' <td>' . $value->m_emp_gross_salary . '</td>
                                                <td>' . $value->m_emp_epfno . '</td>
                                                <td>' . $value->m_emp_esicno . '</td>';
												} ?>
												<td><?php echo $value->m_emp_panno; ?></td>
												<td><?php echo $value->m_emp_mobile; ?></td>
												<td><?php echo $value->m_emp_accno; ?></td>
												<!-- <td><?php echo $value->m_company_name; ?></td> -->
												<!-- <td><?php echo $value->m_dept_name; ?></td> -->
												<!-- <td><?php echo $value->m_design_name; ?></td> -->

												<!-- <td><?php if ($value->m_HrDept_status == 1) echo "Active";
															else {
																echo "In-Active";
															} ?></td>  -->

												<td class="wd-30">

													<button type="button" title="View"
														class="btn btn-info btn-vsm view-employee"
														data-toggle="modal"
														data-target="#myModal"
														data-emp-id="<?= $value->m_emp_id; ?>"
														data-emp-name="<?= $value->m_emp_name; ?>"
														data-emp-code="<?= $value->m_emp_code; ?>"
														data-emp-fname="<?= $value->m_emp_fhname; ?>"
														data-emp-email="<?= $value->m_emp_email; ?>"
														data-emp-mobile="<?= $value->m_emp_mobile; ?>"
														data-emp-dept="<?= $value->m_emp_dept; ?>"
														data-emp-design="<?= $value->m_emp_design; ?>"
														data-emp-company="<?= $value->m_emp_company; ?>"
														data-emp-dob="<?= $value->m_emp_dob; ?>"
														data-emp-doj="<?= $value->m_emp_doj; ?>" >
														<i class="fa fa-eye"></i>
													</button>

													<a href="<?php echo base_url('HrDept/add_employe?id=') . $value->m_emp_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
													<button class="btn btn-danger btn-action delete-employe" data-value="<?php echo $value->m_emp_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>

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
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Employee Details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
					<p><strong>Employee ID:</strong> <span id="employeeId">N/A</span></p>
				<p><strong>Employee Name:</strong> <span id="employeeName">N/A</span></p>
				<p><strong>Employee Code:</strong> <span id="empcode">N/A</span></p>
				<p><strong>Father Name:</strong> <span id="empfname">N/A</span></p>
				<p><strong>Email:</strong> <span id="empmail">N/A</span></p>
				<p><strong>Mobile:</strong> <span id="empmobile">N/A</span></p>
					</div>
					<div class="col-sm-6">
					<p><strong>Department:</strong> <span id="empdepart">N/A</span></p>
				<p><strong>Designation:</strong> <span id="empdesig">N/A</span></p>
				<p><strong>Company:</strong> <span id="empcompany">N/A</span></p>
				<p><strong>DOB:</strong> <span id="empdob">N/A</span></p>
				<p><strong>DOJ:</strong> <span id="empdoj">N/A</span></p>
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



<?php $this->view('footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_hr') ?>

<script>
	$(document).on('click', '.view-employee', function() {
		var empId = $(this).data('emp-id');
		var empName = $(this).data('emp-name');
		var ecode = $(this).data('emp-code');
		var efName = $(this).data('emp-fname');
		var email = $(this).data('emp-email');
		var emobile = $(this).data('emp-mobile');
		var edepart = $(this).data('emp-dept');
		var edesig = $(this).data('emp-design');
		var ecompany = $(this).data('emp-company');
		var edob = $(this).data('emp-dob');
		var edoj = $(this).data('emp-doj');
		$('#employeeId').text(empId);
		$('#employeeName').text(empName);
		$('#empcode').text(ecode);
		$('#empfname').text(efName);
		$('#empmail').text(email);
		$('#empmobile').text(emobile);
		$('#empdepart').text(edepart);
		$('#empdesig').text(edesig);
		$('#empcompany').text(ecompany);
		$('#empdob').text(edob);
		$('#empdoj').text(edoj); 
	});
</script>
