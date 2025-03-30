<?php $this->view('Includes/header'); ?>

<?php $user_id = $this->session->userdata('user_design');
$user_type = $this->session->userdata('user_type');

?>
<style>
	.table td,
	.table th {
		padding: .3rem !important;
	}

	.profile-img {
		width: 50px;
		height: 50px;
		border-radius: 50%;
	}

	.circular-timer {
		width: 100px;
		height: 100px;
		border: 4px solid #007bff;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		font-weight: bold;
		
	}

	.activity-timeline {
		border-left: 2px solid #007bff;
		padding-left: 10px;
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-4">
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-6">
					<form method="post" action="<?php echo site_url('Report/emp_attd_report'); ?>">
						<div class="row">
							<div class="col-sm-6">
								<label class="form-check-label">Month</label>
								<input type="month" name="from_month" value="<?php echo isset($from_month) ? date('Y-m', strtotime('01-' . $from_month)) : date('Y-m'); ?>">
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
									<a class="btn btn-danger" href="<?= site_url('Report/emp_attd_report'); ?>"><i class="fa fa-refresh"></i></a>
								</div>
							</div>
						</div>
					</form>

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
						<div class="card-body" style="overflow-x:scroll;width:100% ;">
							<?php
							$daysInMonth = date('t', strtotime('01-' . $from_month));
							?>
							<div class="d-block">
								<span class="mx-1"><i class="fa fa-check" aria-hidden="true" style="color:#0c3eff"></i> Present </span> |
								<span class="mx-1"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color:red"></i> Late </span> |
								<span class="mx-1"><i class="fa fa-star" aria-hidden="true" style="color: #FFD700"></i> Holiday </span> |
								<span class="mx-1"><i class="fa fa-plane" aria-hidden="true" style="color:red"></i> Leave </span> |
								<span class="mx-1"><i class="fa fa-star-half" aria-hidden="true" style="color:#0c3eff"></i> Half Day </span> |
								<span class="mx-1"><i class="fa fa-times" aria-hidden="true" style="color:#969698"></i> Absent </span>
							</div>
							<table class="table display table-striped table-bordered">
								<thead>
									<tr>
										<th>Employee Name</th>
										<?php
										for ($i = 1; $i <= $daysInMonth; $i++) {
											echo '<th>' . $i . '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!empty($emp_att_del)) {
										foreach ($emp_att_del as $emp_att) {
											echo "<tr>
											<td>" . $emp_att->m_emp_name . "</td>";

											foreach ($emp_att->attdn_status as $record) {
												switch ($record->status) {
													case 1:
														$status = '<span title="Click to see detail" onclick="attd_detail_fun(`' . $record->attd_id . '`,`1`)"><i class="fa fa-check" aria-hidden="true" style="color:#0c3eff"></i></span>'; // Present
														break;
													case 2:
														$status = '<span title="Click to see detail" onclick="attd_detail_fun(`' . $record->attd_id . '`,`1`)"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'; // Missing log
														break;
													case 3:
														$status = '<span title="' . $record->attd_id . '"><i class="fa fa-star" aria-hidden="true" style="color: #FFD700"></i></span>'; // Holiday
														break;
													case 4:
														$status = '<span title="Click to see detail" onclick="attd_detail_fun(`' . $record->attd_id . '`,`2`)"><i class="fa fa-plane" aria-hidden="true" style="color:red"></i></span>'; // Leave
														break;
													case 6:
														$status = '<span title="Click to see detail" onclick="attd_detail_fun(`' . $record->attd_id . '`,`2`)"><i class="fa fa-star-half" aria-hidden="true" style="color:#0c3eff"></i></span>'; // Half-day
														break;
													case 5:
														$status = '<i class="fa fa-times" aria-hidden="true" style="color:#969698"></i>'; // Absent
														break;
													default:
														$status = '-';
												}
												echo "<td>" . $status . "</td>";
											}

											echo "</tr>";
										}
									} else {
										echo "<tr><td colspan='" . ($daysInMonth + 1) . "'>No data available</td></tr>";
									}
									?>
								</tbody>
							</table>
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

<!-- Modal -->

<div class="modal" id="attendanceModal" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="attendanceModalLabel">Attendance Details</h4>
				<button type="button" id="attendanceModalclose" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body" id="attd_dtlbody">
				<!-- Profile Section -->
			
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>



<?php $this->view('Includes/footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_hr') ?>