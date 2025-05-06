<script type="text/javascript">
	$(document).ready(function(e) {

		//=========================== employee ===========================//

		$("form#frm-emp-create").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-emp-create");
			clkbtn.prop("disabled", true);
			var formData = new FormData(this);

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('HrDept/insert_emp'); ?>",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function(data) {
					if (data.status == "success") {
						swal(data.message, {
							icon: "success",
							timer: 1000,
						});
						setTimeout(function() {
							window.location = "<?php echo site_url('HrDept/employe_list'); ?>";
						}, 1000);
					} else {
						clkbtn.prop("disabled", false);
						swal(data.message, {
							icon: "error",
							timer: 5000,
						});
					}
				},
				error: function() {
					clkbtn.prop("disabled", false);
					swal("Some Problem Occurred!! Please try again", {
						icon: "error",
						timer: 2000,
					});
				},
			});
		});

		$("#employe_tbl").on("click", ".delete-employe", function() {
			var clkbtn = $(this);
			clkbtn.prop('disabled', true);
			var dlt_id = $(this).data('value');

			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('HrDept/delete_emp'); ?>",
						data: {
							delete_id: dlt_id
						},
						dataType: "JSON",
						success: function(data) {
							if (data.status == 'success') {
								swal(data.message, {
									icon: "success",
									timer: 1000,
								});
								setTimeout(function() {
									location.reload();
								}, 1000);
							} else {
								clkbtn.prop('disabled', false);
								swal(data.message, {
									icon: "error",
									timer: 5000,
								});
							}
						},
						error: function(jqXHR, status, err) {
							clkbtn.prop('disabled', false);
							swal("Some Problem Occurred!! please try again", {
								icon: "error",
								timer: 2000,
							});
						}
					});

				} else {
					clkbtn.prop('disabled', false);
					swal("Your Data is safe!", {
						icon: "info",
						timer: 2000,
					});
				}
			});
		});



		$(".sbk_delt").on("click", ".delete-sbk", function() {
			// alert("hiiiii");
			var clkbtn = $(this);
			clkbtn.prop('disabled', true);
			var dlt_id = $(this).data('value');
			//console.log(dlt_id);
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('HrDept/delete_slarybk'); ?>",
						data: {
							delete_id: dlt_id

						},
						dataType: "JSON",
						success: function(data) {
							if (data.status == 'success') {
								swal(data.message, {
									icon: "success",
									timer: 2000,
								});
								setTimeout(function() {
									location.reload();
								}, 2000);
							} else {
								clkbtn.prop('disabled', false);
								swal(data.message, {
									icon: "error",
									timer: 5000,
								});
							}
						},
						error: function(jqXHR, status, err) {
							clkbtn.prop('disabled', false);
							swal("Some Problem Occurred!! please try again", {
								icon: "error",
								timer: 2000,
							});
						}
					});

				} else {
					clkbtn.prop('disabled', false);
					swal("Your Data is safe!", {
						icon: "info",
						timer: 2000,
					});
				}
			});
		});



		///////////////////////////employee/////////////////////////


		//=========================== dept ===========================//

		$("form#frm-add-dept").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-add-dept");
			clkbtn.prop('disabled', true);
			var formData = new FormData(this);
			let pgtype = $('#m_dept_type').val();
			if (pgtype == 1) {
				var relink = "department_list";
			} else if (pgtype == 2) {
				var relink = "designation_list";
			} else if (pgtype == 3) {
				var relink = "salaryBreakup_list";
			} else if (pgtype == 4) {
				var relink = "shift_roster_list";
			} else if (pgtype == 5) {
				var relink = "role_list";
			}

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('HrDept/insert_dept'); ?>",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function(data) {
					if (data.status == 'success') {
						swal(data.message, {
							icon: "success",
							timer: 1000,
						});
						setTimeout(function() {
							window.location = "<?php echo site_url('HrDept/'); ?>" + relink;
						}, 1000);
					} else {
						clkbtn.prop('disabled', false);
						swal(data.message, {
							icon: "error",
							timer: 5000,
						});
					}
				},
				error: function(jqXHR, status, err) {
					clkbtn.prop('disabled', false);
					swal("Some Problem Occurred!! please try again", {
						icon: "error",
						timer: 2000,
					});
				}
			});

		});


		$("#dept_tbl").on("click", ".delete-dept", function() {
			var clkbtn = $(this);
			clkbtn.prop('disabled', true);
			var dlt_id = $(this).data('value');

			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('HrDept/delete_dept'); ?>",
						data: {
							delete_id: dlt_id
						},
						dataType: "JSON",
						success: function(data) {
							if (data.status == 'success') {
								swal(data.message, {
									icon: "success",
									timer: 1000,
								});
								setTimeout(function() {
									location.reload();
								}, 1000);
							} else {
								clkbtn.prop('disabled', false);
								swal(data.message, {
									icon: "error",
									timer: 5000,
								});
							}
						},
						error: function(jqXHR, status, err) {
							clkbtn.prop('disabled', false);
							swal("Some Problem Occurred!! please try again", {
								icon: "error",
								timer: 2000,
							});
						}
					});

				} else {
					clkbtn.prop('disabled', false);
					swal("Your Data is safe!", {
						icon: "info",
						timer: 2000,
					});
				}
			});
		});

		//===========================dept===========================//


		//===========================store===========================//

		$("form#frm-add-store").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-add-store");
			clkbtn.prop('disabled', true);
			var formData = new FormData(this);
			let pgtype = $('#m_str_type').val();
			let pglink = '';
			if (pgtype == 1) {
				pglink = "<?php echo site_url('General/store_list'); ?>";
			} else {
				pglink = "<?php echo site_url('General/warehouse_list'); ?>";

			}
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('General/insert_store'); ?>",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function(data) {
					if (data.status == 'success') {
						swal(data.message, {
							icon: "success",
							timer: 1000,
						});
						setTimeout(function() {
							window.location = pglink;
						}, 1000);
					} else {
						clkbtn.prop('disabled', false);
						swal(data.message, {
							icon: "error",
							timer: 5000,
						});
					}
				},
				error: function(jqXHR, status, err) {
					clkbtn.prop('disabled', false);
					swal("Some Problem Occurred!! please try again", {
						icon: "error",
						timer: 2000,
					});
				}
			});

		});


		$("#store_tbl").on("click", ".delete-store", function() {
			var clkbtn = $(this);
			clkbtn.prop('disabled', true);
			var dlt_id = $(this).data('value');

			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('General/delete_store'); ?>",
						data: {
							delete_id: dlt_id
						},
						dataType: "JSON",
						success: function(data) {
							if (data.status == 'success') {
								swal(data.message, {
									icon: "success",
									timer: 1000,
								});
								setTimeout(function() {
									location.reload();
								}, 1000);
							} else {
								clkbtn.prop('disabled', false);
								swal(data.message, {
									icon: "error",
									timer: 5000,
								});
							}
						},
						error: function(jqXHR, status, err) {
							clkbtn.prop('disabled', false);
							swal("Some Problem Occurred!! please try again", {
								icon: "error",
								timer: 2000,
							});
						}
					});

				} else {
					clkbtn.prop('disabled', false);
					swal("Your Data is safe!", {
						icon: "info",
						timer: 2000,
					});
				}
			});
		});

		//===========================Store===========================//


		//===========================holidaye===========================//

		$("form#frm-add-holiday").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-add-holiday");
			clkbtn.prop('disabled', true);
			var formData = new FormData(this);

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('HrDept/insert_holiday'); ?>",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function(data) {
					if (data.status == 'success') {
						swal(data.message, {
							icon: "success",
							timer: 1000,
						});
						setTimeout(function() {
							window.location = "<?php echo site_url('HrDept/holiday_list'); ?>";
						}, 1000);
					} else {
						clkbtn.prop('disabled', false);
						swal(data.message, {
							icon: "error",
							timer: 5000,
						});
					}
				},
				error: function(jqXHR, status, err) {
					clkbtn.prop('disabled', false);
					swal("Some Problem Occurred!! please try again", {
						icon: "error",
						timer: 2000,
					});
				}
			});

		});


		$("#holiday_tbl").on("click", ".delete-holiday", function() {
			var clkbtn = $(this);
			clkbtn.prop('disabled', true);
			var dlt_id = $(this).data('value');

			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('HrDept/delete_holiday'); ?>",
						data: {
							delete_id: dlt_id
						},
						dataType: "JSON",
						success: function(data) {
							if (data.status == 'success') {
								swal(data.message, {
									icon: "success",
									timer: 1000,
								});
								setTimeout(function() {
									location.reload();
								}, 1000);
							} else {
								clkbtn.prop('disabled', false);
								swal(data.message, {
									icon: "error",
									timer: 5000,
								});
							}
						},
						error: function(jqXHR, status, err) {
							clkbtn.prop('disabled', false);
							swal("Some Problem Occurred!! please try again", {
								icon: "error",
								timer: 2000,
							});
						}
					});

				} else {
					clkbtn.prop('disabled', false);
					swal("Your Data is safe!", {
						icon: "info",
						timer: 2000,
					});
				}
			});
		});

		//===========================holidaye===========================//

		//===========================leave===========================//

		$("form#frm-add-leave").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-add-leave");
			clkbtn.prop('disabled', true);
			var formData = new FormData(this);

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('HrDept/insert_leave'); ?>",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function(data) {
					if (data.status == 'success') {
						swal(data.message, {
							icon: "success",
							timer: 1000,
						});
						setTimeout(function() {
							window.location = "<?php echo site_url('HrDept/leave_list'); ?>";
						}, 1000);
					} else {
						clkbtn.prop('disabled', false);
						swal(data.message, {
							icon: "error",
							timer: 5000,
						});
					}
				},
				error: function(jqXHR, status, err) {
					clkbtn.prop('disabled', false);
					swal("Some Problem Occurred!! please try again", {
						icon: "error",
						timer: 2000,
					});
				}
			});

		});


		$("#leave_tbl").on("click", ".delete-leave", function() {
			var clkbtn = $(this);
			clkbtn.prop('disabled', true);
			var dlt_id = $(this).data('value');

			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('HrDept/delete_leave'); ?>",
						data: {
							delete_id: dlt_id
						},
						dataType: "JSON",
						success: function(data) {
							if (data.status == 'success') {
								swal(data.message, {
									icon: "success",
									timer: 1000,
								});
								setTimeout(function() {
									location.reload();
								}, 1000);
							} else {
								clkbtn.prop('disabled', false);
								swal(data.message, {
									icon: "error",
									timer: 5000,
								});
							}
						},
						error: function(jqXHR, status, err) {
							clkbtn.prop('disabled', false);
							swal("Some Problem Occurred!! please try again", {
								icon: "error",
								timer: 2000,
							});
						}
					});

				} else {
					clkbtn.prop('disabled', false);
					swal("Your Data is safe!", {
						icon: "info",
						timer: 2000,
					});
				}
			});
		});

		//===========================leave===========================//



		//=========================== cate ===========================//

		$("form#frm-add-cate").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-add-cate");
			clkbtn.prop('disabled', true);
			var formData = new FormData(this);
			let cattype = $('#m_cat_type').val();
			if (cattype == 1) {
				var relink = "category_list";
			} else if (cattype == 2) {
				var relink = "sub_category_list";
			} else if (cattype == 3) {
				var relink = "product_package_list";
			} else if (cattype == 4) {
				var relink = "product_size_list";
			} else if (cattype == 5) {
				var relink = "product_brand_list";
			}

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Product/insert_cate'); ?>",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function(data) {
					if (data.status == 'success') {
						swal(data.message, {
							icon: "success",
							timer: 1000,
						});
						setTimeout(function() {
							window.location = "<?php echo site_url('Product/'); ?>" + relink;
						}, 1000);
					} else {
						clkbtn.prop('disabled', false);
						swal(data.message, {
							icon: "error",
							timer: 5000,
						});
					}
				},
				error: function(jqXHR, status, err) {
					clkbtn.prop('disabled', false);
					swal("Some Problem Occurred!! please try again", {
						icon: "error",
						timer: 2000,
					});
				}
			});

		});


		$("#cate_tbl").on("click", ".delete-cate", function() {
			var clkbtn = $(this);
			clkbtn.prop('disabled', true);
			var dlt_id = $(this).data('value');

			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('Product/delete_cate'); ?>",
						data: {
							delete_id: dlt_id
						},
						dataType: "JSON",
						success: function(data) {
							if (data.status == 'success') {
								swal(data.message, {
									icon: "success",
									timer: 1000,
								});
								setTimeout(function() {
									location.reload();
								}, 1000);
							} else {
								clkbtn.prop('disabled', false);
								swal(data.message, {
									icon: "error",
									timer: 5000,
								});
							}
						},
						error: function(jqXHR, status, err) {
							clkbtn.prop('disabled', false);
							swal("Some Problem Occurred!! please try again", {
								icon: "error",
								timer: 2000,
							});
						}
					});

				} else {
					clkbtn.prop('disabled', false);
					swal("Your Data is safe!", {
						icon: "info",
						timer: 2000,
					});
				}
			});
		});

		//===========================cate===========================//


		//===========================product===========================//

		$("form#frm-add-product").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-add-product");
			clkbtn.prop('disabled', true);
			var formData = new FormData(this);

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Product/insert_product'); ?>",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function(data) {
					if (data.status == 'success') {
						swal(data.message, {
							icon: "success",
							timer: 1000,
						});
						setTimeout(function() {
							window.location = "<?php echo site_url('Product/product_list'); ?>";
						}, 1000);
					} else {
						clkbtn.prop('disabled', false);
						swal(data.message, {
							icon: "error",
							timer: 5000,
						});
					}
				},
				error: function(jqXHR, status, err) {
					clkbtn.prop('disabled', false);
					swal("Some Problem Occurred!! please try again", {
						icon: "error",
						timer: 2000,
					});
				}
			});

		});


		$("#product_tbl").on("click", ".delete-product", function() {
			var clkbtn = $(this);
			clkbtn.prop('disabled', true);
			var dlt_id = $(this).data('value');

			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('Product/delete_product'); ?>",
						data: {
							delete_id: dlt_id
						},
						dataType: "JSON",
						success: function(data) {
							if (data.status == 'success') {
								swal(data.message, {
									icon: "success",
									timer: 1000,
								});
								setTimeout(function() {
									location.reload();
								}, 1000);
							} else {
								clkbtn.prop('disabled', false);
								swal(data.message, {
									icon: "error",
									timer: 5000,
								});
							}
						},
						error: function(jqXHR, status, err) {
							clkbtn.prop('disabled', false);
							swal("Some Problem Occurred!! please try again", {
								icon: "error",
								timer: 2000,
							});
						}
					});

				} else {
					clkbtn.prop('disabled', false);
					swal("Your Data is safe!", {
						icon: "info",
						timer: 2000,
					});
				}
			});
		});

		//===========================product===========================//


		//===========================batch===========================//

		$("form#frm-add-batch").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-add-batch");
			clkbtn.prop('disabled', true);
			var formData = new FormData(this);

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Product/insert_batch'); ?>",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function(data) {
					if (data.status == 'success') {
						swal(data.message, {
							icon: "success",
							timer: 1000,
						});
						setTimeout(function() {
							window.location = "<?php echo site_url('Product/batch_list'); ?>";
						}, 1000);
					} else {
						clkbtn.prop('disabled', false);
						swal(data.message, {
							icon: "error",
							timer: 5000,
						});
					}
				},
				error: function(jqXHR, status, err) {
					clkbtn.prop('disabled', false);
					swal("Some Problem Occurred!! please try again", {
						icon: "error",
						timer: 2000,
					});
				}
			});

		});


		$("#batch_tbl").on("click", ".delete-batch", function() {
			var clkbtn = $(this);
			clkbtn.prop('disabled', true);
			var dlt_id = $(this).data('value');

			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('Product/delete_batch'); ?>",
						data: {
							delete_id: dlt_id
						},
						dataType: "JSON",
						success: function(data) {
							if (data.status == 'success') {
								swal(data.message, {
									icon: "success",
									timer: 1000,
								});
								setTimeout(function() {
									location.reload();
								}, 1000);
							} else {
								clkbtn.prop('disabled', false);
								swal(data.message, {
									icon: "error",
									timer: 5000,
								});
							}
						},
						error: function(jqXHR, status, err) {
							clkbtn.prop('disabled', false);
							swal("Some Problem Occurred!! please try again", {
								icon: "error",
								timer: 2000,
							});
						}
					});

				} else {
					clkbtn.prop('disabled', false);
					swal("Your Data is safe!", {
						icon: "info",
						timer: 2000,
					});
				}
			});
		});

		//===========================batch===========================//


		$('#attendanceModalclose').click(function() {
			$('#attendanceModal').hide('modal');
		});
	});

	//===========================attenddence report===========================//
	function attd_detail_fun(attd_id, type) {

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('Report/get_attd_detail'); ?>",
			data: {
				attd_id,
				type
			},
			dataType: "JSON",
			success: function(data) {
				if (data.status == 'success') {
					$('#attendanceModal').show('modal');
					if (type == 1) {
						$('#attd_dtlbody').html(`<div class="d-flex align-items-center mb-3">
								<img src="profile.jpg" alt="Profile" class="profile-img mr-3">
								<div>
									<h5 class="mb-0">${data.data.m_emp_name}</h5>
									<small class="text-muted">${data.data.m_emp_mobile}</small>
								</div>
							</div>
			
							<!-- Date & Attendance Info -->
							<h6 class="mb-3">Date - ${formatDate(data.data.m_date,1)}</h6>
			
							<div class="row">
								<div class="col-md-6">
									<div class="p-3 border rounded">
										<h6>Clock In</h6>
										<p class="mb-0">${convertTo12Hour(data.data.m_time_in)}</p>
									</div>
									<div class="mt-3 text-center">
										<div class="circular-timer ">${getTimeDifference(data.data.m_time_in,data.data.m_time_out)}</div>
									</div>
									<div class="mt-3 p-3 border rounded">
										<h6>Clock Out</h6>
										<p class="mb-0">${convertTo12Hour(data.data.m_time_out)}</p>
									</div>
								</div>
			
								<div class="col-md-6">
									<div class="p-3 border rounded">
										<h6>Activity</h6>
										<div class="activity-timeline">
											<p class="mb-1"><strong>Clock In</strong> <span class="badge badge-primary">${data.data.m_dept_name}</span></p>
											<small>${formatDate(data.data.m_date,2)} ${convertTo12Hour(data.data.m_time_in)}</small>
											
											<p class="mt-3 mb-1"><strong>Clock Out</strong></p>
											<small>${formatDate(data.data.m_date,2)} ${convertTo12Hour(data.data.m_time_out)}</small>
										</div>
									</div>
								</div>
							</div>`);
					} else {
						$('#attd_dtlbody').html(`<div class="d-flex align-items-center mb-3">
									<img src="profile.jpg" alt="Profile" class="profile-img mr-3">
									<div>
										<h5 class="mb-0">${data.data.m_emp_name}</h5>
										<small class="text-muted">${data.data.m_emp_mobile}</small>
									</div>
								</div>
				
								<div class="row">
									<div class="col-md-6">
										<div class="p-3 border rounded">
											<div class="row">
												<div class="col-md-6">
													<h6>From</h6>
													<p class="mb-0">${formatDate(data.data.m_leav_fromdate,2)}</p>
												</div>
												<div class="col-md-6">
													<h6>To</h6>
													<p class="mb-0">${formatDate(data.data.m_leav_todate,2)}</p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<h6>Type</h6>
													<p class="mb-0">${data.data.m_leav_type}</p>
												</div>
												<div class="col-md-6">
													<h6>To</h6>
													<p class="mb-0">${formatDate(data.data.m_leav_todate,2)}</p>
												</div>
											</div>
										</div>
									</div>
				
									<div class="col-md-6">
										<div class="p-3 border rounded">
											<p><strong>Leave Description: </strong> ${data.data.m_leav_absence}</p>
										</div>
									</div>
								</div>`);

					}
				}
			},
			error: function(jqXHR, status, err) {
				clkbtn.prop('disabled', false);
				swal("Some Problem Occurred!! please try again", {
					icon: "error",
					timer: 2000,
				});
			}
		});
	}

	function formatDate(inputDate, ty) {
		let date = new Date(inputDate); // Convert string to Date object

		let day = date.getDate(); // Get day (1-31)
		let month = date.getMonth() + 1; // Get month (0-11, so add 1)
		let year = date.getFullYear(); // Get full year

		let dayOfWeek = date.toLocaleDateString('en-GB', {
			weekday: 'long'
		}); // Get day name
		let formattedDate = '';
		if (ty == 1) {
			formattedDate = `${day.toString().padStart(2, '0')}-${month.toString().padStart(2, '0')}-${year} (${dayOfWeek})`;
		} else {
			formattedDate = `${day.toString().padStart(2, '0')}-${month.toString().padStart(2, '0')}-${year}`;
		}

		return formattedDate;
	}

	function convertTo12Hour(timeString) {
		let [hours, minutes] = timeString.split(":").map(Number); // Extract hours & minutes

		let ampm = hours >= 12 ? "PM" : "AM"; // Determine AM or PM
		hours = hours % 12 || 12; // Convert hours to 12-hour format

		return `${hours}:${minutes.toString().padStart(2, "0")} ${ampm}`;
	}

	function getTimeDifference(startTime, endTime) {
		let start = new Date(`1970-01-01T${startTime}Z`); // Convert to Date object
		let end = new Date(`1970-01-01T${endTime}Z`);

		let diffMs = end - start; // Difference in milliseconds
		let diffSec = Math.floor(diffMs / 1000); // Convert to seconds
		let hours = Math.floor(diffSec / 3600); // Convert to hours
		let minutes = Math.floor((diffSec % 3600) / 60); // Remaining minutes
		let seconds = diffSec % 60; // Remaining seconds

		return `${hours}h ${minutes}m ${seconds}s`;
	}
	//===========================attenddence report===========================//
</script>